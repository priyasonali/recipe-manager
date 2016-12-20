#### [Back to Index](./index.html)

# Getting Started

- Clone, Fork-Clone or Download the project repository.
- Update the `root` path in the `/config.json` file depending on where you decide to put the repository relative to your web hosting root.
- Install Composer for PHP inside of the `/api` directory. Watch [this youtube video](https://www.youtube.com/watch?v=BnIZVHmROkk) or visit [Composer's website](https://getcomposer.org/) for instructions if necessary.
- Create a MySQL database for the project and a pair of credentials to go along with it.
- Copy and/or rename the file `class.database.php.sample` in the `/api/includes/` directory to `class.database.php` in the same directory and fill in your database details in it.
- Use the [/api/install](./install.html) endpoint to prepare the database.
- The API is now ready to be used for building a front end application.
