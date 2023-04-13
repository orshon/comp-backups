from django.contrib.auth import authenticate, login, logout
from django.db import IntegrityError
from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import render
from django.urls import reverse
from django.contrib.auth.decorators import login_required
from .models import User, listing, Watchlist, comment, bid
from datetime import datetime

def index(request):
    list_listings = listing.objects.filter(is_active=True)
    return render(request, "auctions/index.html", {
       "list_listings": list_listings
        })


def login_view(request):
    if request.method == "POST":

        # Attempt to sign user in
        username = request.POST["username"]
        password = request.POST["password"]
        user = authenticate(request, username=username, password=password)

        # Check if authentication successful
        if user is not None:
            login(request, user)
            return HttpResponseRedirect(reverse("index"))
        else:
            return render(request, "auctions/login.html", {
                "message": "Invalid username and/or password."
            })
    else:
        return render(request, "auctions/login.html")


def logout_view(request):
    logout(request)
    return HttpResponseRedirect(reverse("index"))


def register(request):
    if request.method == "POST":
        username = request.POST["username"]
        email = request.POST["email"]

        # Ensure password matches confirmation
        password = request.POST["password"]
        confirmation = request.POST["confirmation"]
        if password != confirmation:
            return render(request, "auctions/register.html", {
                "message": "Passwords must match."
            })

        # Attempt to create new user
        try:
            user = User.objects.create_user(username, email, password)
            user.save()
        except IntegrityError:
            return render(request, "auctions/register.html", {
                "message": "Username already taken."
            })
        login(request, user)
        return HttpResponseRedirect(reverse("index"))
    else:
        return render(request, "auctions/register.html")

@login_required(login_url='/login')
def getlisting(request, id):
    list = bid.objects.filter(listingid=id)
    bids = []
    for i in list:
        bids.append(bid.objects.filter(listingid=i.listingid))
    return render(request, "auctions/listing.html", {
            "listing": listing.objects.get(id=id),
            "comments": comment.objects.filter(listingid=id),
            "maxbid": bid.objects.get(amount=listing.objects.get(id=id).min_bid),
            "bidlist": bids
            })

@login_required(login_url='/login')
def addlisting(request):
    if request.method == "POST":
        newlisting = listing()
        newlisting.seller = request.user.username
        newlisting.title = request.POST["title"]
        newlisting.description = request.POST["description"]
        newlisting.min_bid = request.POST["min_bid"]
        newlisting.save()
        new = bid(amount=newlisting.min_bid, bidder_username=request.user.username, listingid=newlisting.id)
        newlisting.category = request.POST["category"]
        if request.POST["pic_url"]:
            newlisting.pic_url = request.POST["pic_url"]
        else:
            newlisting.pic_url = "https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"
        newlisting.save()
        new.save()
        return render(request, "auctions/listing.html", {
            "listing": newlisting
            })
    else:
        return render(request, "auctions/addlisting.html")

@login_required(login_url='/login')
def getwatchlist(request):
    list = Watchlist.objects.filter(username=request.user.username)
    listings = []
    for i in list:
        listings.append(listing.objects.filter(id=i.listingid))
    return render(request, "auctions/watchlist.html", {
       "listings": listings
        })

@login_required(login_url='/login')
def addwatchlist(request, listingid):
    item = Watchlist.objects.filter(username=request.user.username, listingid=listingid)
    if item:
        item.delete()
        return getwatchlist(request)
    else:
        new = Watchlist(listingid = listingid, username = request.user.username)
        new.save()
        return render(request, "auctions/listing.html", {
            "listing": listing.objects.get(id=new.listingid),
            "comments": comment.objects.filter(listingid=new.listingid),
            "maxbid": bid.objects.get(amount=listing.objects.get(id=listingid).min_bid)
            })

@login_required(login_url='/login')
def category(request, category):
    list_listings = listing.objects.filter(is_active=True)
    list=[]
    for i in list_listings:
        if i.category == category:
            list.append(i)
    return render(request, "auctions/category.html", {
        "category": category,
        "list": list
        })

@login_required(login_url='/login')
def categories(request):
     list_listings = listing.objects.all()
     categories = []
     for i in list_listings:
         if i.category != None:
             if i.category not in categories:
                 categories.append(i.category)
     return render(request, "auctions/categories.html", {
             "list": categories
                  })

@login_required(login_url='/login')
def comments(request, listingid):
      cmnt = comment(username=request.user.username, date=datetime.now(), content = request.POST["contentcmt"], listingid=listingid)
      cmnt.save()
      return render(request, "auctions/listing.html", {
            "listing": listing.objects.get(id=listingid),
            "comments": comment.objects.filter(listingid=listingid),
            "maxbid": bid.objects.get(amount=listing.objects.get(id=listingid).min_bid)
            })


@login_required(login_url='/login')
def close(request, listingid):
    lst = listing.objects.get(id=listingid)
    lst.is_active = False
    lst.save()
    return render(request, "auctions/listing.html", {
            "listing": lst,
            "comments": comment.objects.filter(listingid=listingid),
            "maxbid": bid.objects.get(amount=listing.objects.get(id=listingid).min_bid)
            })

@login_required(login_url='/login')
def bidding(request, listingid):
    if int(listing.objects.get(id=listingid).min_bid) < int(request.POST['bidamount']):
        oldbid = bid.objects.filter(listingid=listingid)
        if oldbid:
            oldbid.delete()
        newbid = bid(amount=request.POST['bidamount'], bidder_username=request.user.username, listingid=listingid)
        newbid.save()
        listings= listing.objects.get(id=listingid)
        listings.min_bid = newbid.amount
        listings.save()
        list = bid.objects.filter(listingid=listingid)
        return render(request, "auctions/listing.html", {
                "listing": listing.objects.get(id=listingid),
                "comments": comment.objects.filter(listingid=listingid),
                "maxbid": bid.objects.get(amount=listing.objects.get(id=listingid).min_bid),
                "message": "bid listed!",
                })
    return render(request, "auctions/listing.html", {
                "listing": listing.objects.get(id=listingid),
                "comments": comment.objects.filter(listingid=listingid),
                "maxbid": bid.objects.get(amount=listing.objects.get(id=listingid).min_bid),
                "message": "your bid has to be higher than the current bid"
                })
