#### [Back to Index](./index.html)

# API requests and responses

## Forgot Password

### Request

#### Endpoint:
```
POST /api/?action=forgotpass
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| user_email | Self Explanatory | A valid email address string |

### Response

#### Success Cases:

```js
    {
    "status": "success"
    }
```


#### Failure Cases:
  
__Case 1__ - Invalid email:

```js
    {
    "status": "failure",
     "error": {
     "err_code": 4,
     "err_desc": "Invalid email address."
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

__Case 3__ - Query fail:

```js
    {
    "status": "failure",
    "error": {
    "err_code": 5,
    "err_desc": "Query failed."
       }
    }
```