# API requests and responses

## Reset password

### Request

#### Endpoint:
```
POST /api/?action=resetpass
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| user_pass | Self Explanatory | Current password |
| user_new_pass | New Password | A valid new password |

#### Authentication Token:

Send the generated *authentication token* in headers as :
```
authorization : token
```
### Response

#### Success Cases:

```js
    {
        "status": "success"
    }
```

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

__Case 2__ - Query fail:

```js
    {
    "status": "failure",
    "error": {
    "err_code": 5,
    "err_desc": "Query failed."
        }
    }
```

__Case 3__ - Invalid Password:

```js
    {
    "status": "failure",
    "error": {
    "err_code": 6,
    "err_desc": "Invalid password."
        }
    }
```