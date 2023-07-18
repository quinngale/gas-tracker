from typing import Any, Dict
from django.views.generic import CreateView, UpdateView
from django.contrib.auth import views as auth_views
from django.contrib.auth.models import User
from django import http, urls

from . import forms


# Create your views here.


class SignUp(CreateView):
    form_class = forms.RegistrationForm
    success_url = urls.reverse_lazy("account:signin")

    template_name = "account/signup.html"


class SignIn(auth_views.LoginView):
    redirect_authenticated_user = urls.reverse_lazy("index")

    template_name = "account/signin.html"


class Profile(UpdateView):
    model = User
    form_class = forms.ProfileForm

    template_name = "account/profile.html"

    def get_success_url(self) -> str:
        return urls.reverse("account:profile", kwargs={"pk": self.request.user.pk})


class UpdatePassword(auth_views.PasswordChangeView):
    model = User

    template_name = "account/update-password.html"

    def get_success_url(self) -> str:
        return urls.reverse("account:profile", kwargs={"pk": self.request.user.pk})


class SignOut(auth_views.LogoutView):
    template_name = "account/signout.html"
