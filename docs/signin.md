# API requests and responses

## Sign in

### Request

#### Endpoint:
```
POST /api/?action=signin
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| user_name | Self Explanatory | Registered valid user name string |
| user_pass | Self Explanatory | A valid password |

### Response

#### Success Cases:

```js
    {
    "status": "Logged in",
    "authentication_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiJ9.138NdeGE3jsdOWZiU5DSHDXoXejkJq2qL5NEUn37Eu8"
    }
```

>Authentication token is generated on successful login. Which is required for further query.

#### Failure Cases:
  

__Case 1__ - Invalid details:

```js
    {
    "status": "Failed",
    "error": {
        "err_code": 3,
        "err_desc": "Invalid login details."
         }
    }
```

__Case 2__ - Blank fields:

```js
    {
    "error": {
    "err_code": 2,
    "err_desc": "Please enter the details."
        }
    }
```