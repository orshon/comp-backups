from django.contrib.auth.models import AbstractUser
from django.db import models


class User(AbstractUser):
    pass

class Watchlist(models.Model):
    username = models.CharField(max_length=16)
    listingid = models.IntegerField()

    def __str__(self):
        return "user "+self.username+" has listing "+str(self.listingid)+" in watchlist"

 
class comment(models.Model):
    username = models.CharField(max_length=16)
    date = models.DateField(max_length=11)
    content = models.CharField(max_length=144)
    listingid = models.IntegerField(default=111111)

    def __str__(self):
        return "user "+self.username+" commented: "+self.content+" at "+str(self.date)


class listing(models.Model):
    seller = models.CharField(max_length=16)
    title = models.CharField(max_length=50, unique=True)
    category = models.CharField(max_length=26)
    description = models.TextField()
    min_bid = models.IntegerField()
    pic_url = models.CharField(max_length=500)
    is_active = models.BooleanField(default=True)

    def __str__(self):
        return self.title+"is "+str(self.is_active)+" description: "+self.description+" from category "+self.category+" who's minimun bid is "+str(self.min_bid)+"$ and is sold by "+self.seller

class bid(models.Model):
    bidder_username = models.CharField(max_length=16)
    listingid = models.IntegerField(default=0)
    amount = models.IntegerField()

    def __str__(self):
        return "bidding on: "+str(self.listingid)+" bidder is: "+self.bidder_username+" amount is "+str(self.amount)+"$"