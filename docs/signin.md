#### [Back to Index](./index.html)

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
| user_name | Self Explanatory | Registered valid user name string (lowercase, length: 3 - 12) |
| user_pass | Self Explanatory | A valid password (minimum 1 lowercase, 1 uppercase, 1 digit and 1 special character from the list [!,=,@,#,$,%,^,&,-] brackets and comma not included, length: min. 8) |

### Response

#### Success Cases:

```js
    {
    "status": "success",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiJ9.138NdeGE3jsdOWZiU5DSHDXoXejkJq2qL5NEUn37Eu8"
    }
```

>Authentication token is generated on successful login. Which is required for further query.

#### Failure Cases:
  

__Case 1__ - Invalid details:

```js
    {
    "status": "failure",
    "error": {
        "err_code": 3,
        "err_desc": "Invalid login details."
         }
    }
```

__Case 2__ - Blank fields:

```js
    {
    "status": "failure",
    "error": {
    "err_code": 2,
    "err_desc": "Please enter the details."
        }
    }
```
