# Info
Facebook API Version 2.10


## How to obtain permanent (never expiring) Facebook Access Token ?
If you are a mobile app developer or web developer then there is a good chance that you have worked with Facebook Graph API. There are a lot of situations when you need to have permanent access token for accessing the Facebook Graph API.

## What is Permanent Access Token?
Normal Access Tokens which you receive from the Facebook API are short-lived for about 2-3 hours, but there are some tokens which never expire. The tokens which never expire are called Permanent Access Token.

## How?
Here is the procedure.

## 0. Create Facebook App
If you already have a Facebook App, then you can skip this step.

1. Go to My Apps.
2. Click on “Add a New App” button.
3. Fill Display Name and Contact Email.

## 1. Get Short Lived Access Token
1. Go to Facebook Graph API Explorer (https://developers.facebook.com/tools/explorer).
2. Select the application you want to get the access token for from Application drop-down menu, on top right.
3. Click ‘Get Token’ and then ‘Get User Access Token’.
4. In the pop-up, under the “Extended Permissions” tab, check “manage_pages” and other permissions if you need.
5. Click “Get Access Token” button.
6. Grant access from a Facebook account that has access to manage the target page. 
7. Token that appears in the “Access Token” field is your short-lived access token.

## 2. Generate Long Lived Access Token
Make a Get Request to this URL uring Postman or Simple Browser

https://graph.facebook.com/v2.10/oauth/access_token?grant_type=fb_exchange_token&client_id={app_id}&client_secret={app_secret}&fb_exchange_token={short_lived_token}
- Client ID is your App ID
- Client Secret can be obtained from Facebook App Settings page which you selected.
- Short Lived Token which is obtained in step 1.

Response received is JSON and it looks like this:
```json
{
"access_token": "XYZ123",
"token_type": "bearer",
}
```
You can also verify the expiry time using Access Token Debugger, it will show some value like 2 months

## 3. Get your User ID
Make a GET Request to this URL

https://graph.facebook.com/v2.10/me?access_token={long_lived_token}
-long_lived_token  is the token obtained in previous step.

Response received is JSON and it looks like this: 
```json
{
  'name': 'Filipe Mansano',
  'id': xxxxxxxxx
}
```

Note down the above id field for next step.

## 4. Get Permanent Access Token
Make GET Request to this URL

https://graph.facebook.com/v2.10/{account_id}/accounts?access_token={long_lived_access_token}
- account_id – It is your User ID received in previous step.
- long_lived_access_token – It is the long lived access token received in step 2 above.

Again you will get the JSON response and it will have a data field which is array of all the items to which access token has access to. Find the page array element in the response for which you want the permanent access token. The access_token field for that element will be your Permanent Access Token

https://developers.facebook.com/tools/debug/accesstoken

You can verify it again using Access Token Debugger. Expires field will say “Never”.
