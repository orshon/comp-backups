from django.urls import path

from . import views

urlpatterns = [
    path("", views.index, name="index"),
    path("login", views.login_view, name="login"),
    path("logout", views.logout_view, name="logout"),
    path("register", views.register, name="register"),
    path("watchlist", views.getwatchlist, name="getwatchlist"),path("<int:id>", views.getlisting, name="getlisting"),
    path("addlisting", views.addlisting, name="addlisting"),
    path("addwatchlist/<int:listingid>", views.addwatchlist, name="addwatchlist"),
    path("categories", views.categories, name="categories"),
    path("<str:category>", views.category, name="category"),
    path("comments/<int:listingid>", views.comments, name="comments"),
    path("bid/<int:listingid>", views.bidding, name="bidding"),
    path("close/<int:listingid>", views.close, name="close")
]
