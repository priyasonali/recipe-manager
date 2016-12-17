# API requests and responses

## Registration

### Request

#### Endpoint:
```
POST /api/?action=registration
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| user_email | Self Explanatory | A valid email address string |
| user_name | Self Explanatory | A valid string, lowercase, min 4, max 12 |

### Response

#### Success Cases:

    {
    "status": "Success"
    }


#### Failure Cases:
  
__Case 1__ - Email exists:

    {
     "error": {
     "err_code": 0,
     "err_desc": "This email is already registered."
      }
    }

__Case 2__ - Username exists:

    {
    "error": {
    "err_code": 1,
    "err_desc": "This username is taken."
       }
    }

Blank fields:

    {
    "error": {
    "err_code": 2,
    "err_desc": "Please enter the details."
        }
    }

Query fail:

    {
    "status": "Failed",
    "error": {
    "err_code": 2,
    "err_desc": "Query failed. Server error."
       }
    }