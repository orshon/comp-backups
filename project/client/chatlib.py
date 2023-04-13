# Protocol Constants

CMD_FIELD_LENGTH = 16	# Exact length of cmd field (in bytes)
LENGTH_FIELD_LENGTH = 4   # Exact length of length field (in bytes)
MAX_DATA_LENGTH = 10**LENGTH_FIELD_LENGTH-1  # Max size of data field according to protocol
MSG_HEADER_LENGTH = CMD_FIELD_LENGTH + 1 + LENGTH_FIELD_LENGTH + 1  # Exact size of header (CMD+LENGTH fields)
MAX_MSG_LENGTH = MSG_HEADER_LENGTH + MAX_DATA_LENGTH  # Max size of total message
DELIMITER = "|"  # Delimiter character in protocol
DATA_DELIMITER = "#"  # Delimiter in the data part of the message

# Protocol Messages 
# In this dictionary we will have all the client and server command names

PROTOCOL_CLIENT = {
"login_msg" : "LOGIN",
"logout_msg" : "LOGOUT"
} # .. Add more commands if needed


PROTOCOL_SERVER = {
"login_ok_msg" : "LOGIN_OK",
"login_failed_msg" : "ERROR"
} # ..  Add more commands if needed


# Other constants

ERROR_RETURN = None  # What is returned in case of an error


def build_message(cmd, data):
	if not isinstance(cmd , str) or not isinstance(data , str):
		return None
	if len(cmd) > CMD_FIELD_LENGTH:
		return None
	tostr = ""
	spaces = CMD_FIELD_LENGTH - len(cmd)
	length = len(data)
	if length <10:
		tostr = "000"+str(length)
	if length <=100 and length >= 10:
		tostr = "00"+str(length)
	if length >= 100 and length <= 1000:
		tostr = "0"+str(length)
	if length > 9999 or length < 0:
		return None
	if length >= 1000:
		tostr = str(length)
	full_msg = cmd +" "*spaces+DELIMITER+tostr+DELIMITER+data
	return full_msg


def parse_message(data):
	cmd = ""
	msg = ""
	lng = ""
	num = ""
	dcnt = 0
	if data.count(DELIMITER) != 2:
		return None, None
	for char in data:
		if char == DELIMITER:
			dcnt = dcnt + 1
			continue
		if char != " " and dcnt == 0:
			cmd = cmd + char
		if char != " " and dcnt == 1:
			if char.isnumeric():
				lng = lng + char
			else:
				return None, None
		if dcnt == 2:
			msg = msg + char
	for letter in lng:
		if letter != "0":
			num = num + letter
		if num != "" and letter == "0":
			num = num + letter
		if num == "" and letter == "0":
			continue
	if str(len(msg)) != num:
		return None, None
	return cmd, msg


def split_data(msg, expected_fields):
	cnt = msg.count("#") 
	if cnt == expected_fields:
		return msg.split("#")
	else:
	    return [None]

def join_data(msg_fields):
	cnt=-1
	for item in msg_fields:
		cnt=cnt+1
		if not isinstance(item, str):
			msg_fields[cnt] = str(item)
	return "#".join(msg_fields)



