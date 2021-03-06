#### [Back to Index](./index.html)

# API requests and responses

## Email validation

### Request

#### Endpoint:
```
POST /api/?action=validate
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| user_email | Self Explanatory | A valid email address |
| user_code | Server generated code |  A valid six digit code generated by server |
| user_check | To check if users email is activated | True |

### Response

#### Success Cases:

__Case 1__ - For user:

```js
    {
    "status": "success",
    "msg": "Your email is activated."
    }
```

__Case 2__ - user_check is true:

```js
    {
    "status": "failure",
    "error": {
        "err_code": 7,
        "err_desc": "Email not activated."
         }
    }
```


#### Failure Cases:
  

__Case 1__ - Already activated:

```js
    {
    "status": "failure",
    "error": {
        "err_code": 8,
        "err_desc": "Email already activated."
         }
    }
```

__Case 2__ - Already registered:

```js
    {
    "status": "failure",
    "error": {
        "err_code": 0,
        "err_desc": "This email is already registered."
         }
    }
```

__Case 3__ - Invalid code:

```js
    {
    "status": "failure",
    "error": {
    "err_code": 9,
    "err_desc": "Invalid url."
        }
    }
```

__Case 4__ - Valid email & invalid code:

> Email is send to the user with the link containing code.

```js
    {
    "status": "failure",
    "error": {
    "err_code": 7,
    "err_desc": "Email not activated."
        }
    }
```

__Case 5__ - Blank code & activated email:


```js
    {
    "status": "failure",
    "error": {
    "err_code": 8,
    "err_desc": "Email already activated."
        }
    }
```

__Case 6__ - Blank code & email exists:

> Email is send to the user with the link containing updated code.

```js
    {
    "status": "failure",
    "error": {
    "err_code": 7,
    "err_desc": "Email not activated."
        }
    }
```

__Case 7__ - Blank code & email does not exists:

> Email is send to the user with the link containing code.

```js
    {
    "status": "failure",
    "error": {
    "err_code": 7,
    "err_desc": "Email not activated."
        }
    }
```

__Case 8__ - Blank code & email:


```js
    {
    "status": "failure",
    "error": {
    "err_code": 9,
    "err_desc": "Invalid url."
        }
    }
```
