from django.shortcuts import render, redirect

# Create your views here.


def login(request):
    return render(request, 'accounts/login.html')


def create_account(request):
    return render(request, 'accounts/create_account.html')
