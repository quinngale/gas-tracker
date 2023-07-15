from django.urls import path

from . import views

app_name = "accounts"

urlpatterns = [
    path("signin", views.SignIn.as_view(), name="signin"),
    path("signout", views.SignOut.as_view(), name="signout"),
    path("signup", views.SignUp.as_view(), name="signup"),
]
