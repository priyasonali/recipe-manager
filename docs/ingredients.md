#### [Back to Index](./index.html)

# API requests and responses

## Ingredients

### Request

#### Endpoint:
```
POST /api/?action=ingredients
```

#### Fields:

| Field | Desc | Possible Values |
|:---:|:---:|:---:|
| ing_name | Ingredient name | A valid string |
| user_check | To check if users email is activated | True |

### Response

#### Success Cases:

__Case 1__ - Ingredient added:

```js
    {
    "status": "success"
    }
```

__Case 2__ - user_check is true:

 Response 1:

```js
    {
    "status": "success",
    "result": [
        //list of present ingredients for requested user
    ]
    }
```

Response 2:

```js
    {
    "status": "failure",
    "error": {
        "err_code": 11,
        "err_desc": "There is no ingredients."
         }
    }
```


#### Failure Cases:
  

__Case 1__ - Invalid login:

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

__Case 4__ - Ingredient exists:


```js
    {
    "status": "failure",
    "error": {
    "err_code": 10,
    "err_desc": "Ingredient already exists."
        }
    }
```