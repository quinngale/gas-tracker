from django import forms

from django.contrib.auth.models import User
from django.contrib.auth import forms as auth_forms


class RegistrationForm(auth_forms.UserCreationForm):
    email = forms.EmailField(required=True)

    class Meta:
        model = User
        fields = ["username", "email", "password1", "password2"]


class ProfileForm(forms.ModelForm):
    email = forms.EmailField(required=True)

    class Meta:
        model = User

        fields = ["username", "email"]
