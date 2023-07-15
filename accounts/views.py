from typing import Any
from django.shortcuts import render, redirect
from django.views.generic import CreateView
from django.contrib.auth import views as accounts_views
from django import http, urls

from . import forms


# Create your views here.


class SignIn(accounts_views.LoginView):
    redirect_authenticated_user = urls.reverse_lazy("index")

    template_name = "accounts/signin.html"


class SignOut(accounts_views.LogoutView):
    template_name = "accounts/signout.html"


class SignUp(CreateView):
    form_class = forms.RegistrationForm
    success_url = urls.reverse_lazy("accounts:login")

    template_name = "accounts/signup.html"
