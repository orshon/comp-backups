from django.contrib import admin
from .models import User, comment, Watchlist, listing, bid

# Register your models here.
admin.site.register(User)
admin.site.register(listing)
admin.site.register(Watchlist)
admin.site.register(comment)
admin.site.register(bid)