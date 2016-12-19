# API database installer

### Request

#### Endpoint:
```
POST /api/install?
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| db_name | Databse Name | Valid database name |
| db_user | Databse Username | Valid username associated with the database |
| db_pass | Databse Password | Valid password associated with the username or blank if no password  |

### Response

#### Success Cases:

```js
    {
        "status": "success"
    }
```

#### Failure Cases:
  

__Case 1__ - Any error:

```js
    {
    "status": "failure",
    "error": {
        "err_desc": //error description
         }
    }
```