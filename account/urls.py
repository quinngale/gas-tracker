from django.urls import path

from . import views

app_name = "account"

urlpatterns = [
    path("signin", views.SignIn.as_view(), name="signin"),
    path("signout", views.SignOut.as_view(), name="signout"),
    path("signup", views.SignUp.as_view(), name="signup"),
    path("profile/<int:pk>", views.Profile.as_view(), name="profile"),
    path(
        "profile/<int:pk>/update-password",
        views.UpdatePassword.as_view(),
        name="update-password",
    ),
]
