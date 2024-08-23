# Class Documentation: `x_class_mysql` 

## Documentation
The `x_class_mysql` class provides an interface for interacting with a MySQL database. It encapsulates common database operations and includes additional features for error handling and logging.

- **Error Handling**: Errors are managed by the `handler` method which updates internal error states and logs errors if configured.  
- **Benchmarking**: Provides a simple benchmarking system to count operations.  
- **Logging**: Allows configuration of logging to both the database and log files, with options to control logging behavior.  
- **Parameter Binding**: When using prepared statements, ensure that `bindarray` is correctly formatted. The `type` key in each array element specifies the type of data being bound.  

## Requirements

### PHP Modules
- `MySQLi`: Required for database interactions.  
- **Exception Handling**: Required for handling errors.  

### External Classes
- `none`: None External Classes are Required.  



## Table Structure

This section describes the table structure used by the MySQL class to log failures if logging is activated. The table is automatically created by the class if necessary. Below is a summary of the columns and keys used in the table, along with their purposes.


| Column Name   | Data Type    | Attributes                                    | Description                                                                                         |
|---------------|--------------|-----------------------------------------------|-----------------------------------------------------------------------------------------------------|
| `id`          | `int(10)`    | `NOT NULL`, `AUTO_INCREMENT`, `PRIMARY KEY`  | A unique identifier for each log entry, ensuring that each record can be individually tracked.      |
| `url`         | `varchar(256)` | `DEFAULT NULL`                              | Stores the URL related to the log entry, providing context for where the failure occurred.          |
| `init`        | `text`       | `NULL`                                      | Contains initialization data, if available, that might provide additional context about the failure.|
| `exception`   | `text`       | `NULL`                                      | Logs the text of any exception that was thrown, useful for diagnosing issues.                      |
| `sqlerror`    | `text`       | `NULL`                                      | Records the MySQL error message if there was an SQL error, aiding in troubleshooting.               |
| `output`      | `text`       | `NULL`                                      | Stores the output related to the error, which can provide additional details about the failure.     |
| `success`     | `int(1)`     | `NULL`                                      | Indicates the result of the query: `1` for success, `2` for error, or `NULL` if not applicable.     |
| `creation`    | `datetime`   | `DEFAULT CURRENT_TIMESTAMP`                 | Records the timestamp when the log entry was created, allowing for chronological tracking.         |
| `section`     | `varchar(128)` | `DEFAULT NULL`                              | For Multi Site Purposes to split database data in categories.              |


| Key Name      | Key Type  | Columns | Usage                                                                                                  |
|---------------|-----------|---------|--------------------------------------------------------------------------------------------------------|
| `PRIMARY KEY` | Primary   | `id`    | Ensures that each log entry is uniquely identifiable.                                                  |



## Class Usage
### Constructors

| Method/Function       | Parameters                                             | Description                                              |
|-----------------------|--------------------------------------------------------|----------------------------------------------------------|
| `__construct`         | `($hostname, $username, $password, $database, $port)` | Initializes a new MySQL connection using the provided credentials and database information. |
| `construct`           | -                                                      | Returns a new instance of `x_class_mysql` with the same connection parameters. |
| `construct_copy`      | -                                                      | Returns the current instance of `x_class_mysql`. |

### Status and Errors

| Method/Function       | Parameters                                             | Description                                              |
|-----------------------|--------------------------------------------------------|----------------------------------------------------------|
| `status`              | -                                                      | Alias for `ping()`. Checks if the database connection is alive. |
| `con`                 | -                                                      | Returns the MySQLi connection object.                   |
| `lastError`           | -                                                      | Returns the last error that occurred during database operations. |
| `fullError`           | -                                                      | Returns detailed error information.                     |
| `ping`                | -                                                      | Checks if the MySQL server is reachable. Uses `mysqli_ping()`. |
| `inject`              | `$mysqli`                                              | Injects an external MySQLi connection object.            |
| `displayError`        | `$exit = true, $response_code = 503`                   | Displays an error message and optionally exits the script. |

### Benchmarking

| Method/Function       | Parameters                                             | Description                                              |
|-----------------------|--------------------------------------------------------|----------------------------------------------------------|
| `benchmark_get`       | -                                                      | Retrieves the current benchmark count.                  |
| `benchmark_raise`     | `$raise = 1`                                          | Increments the benchmark counter.                       |
| `benchmark_config`    | `$bool = false, $preecookie = ""`                      | Configures benchmarking and session cookie prefix.      |

### Logging

| Method/Function       | Parameters                                             | Description                                              |
|-----------------------|--------------------------------------------------------|----------------------------------------------------------|
| `logfile_messages`    | `$bool = false`                                       | Enables or disables logging of error messages to a file. |
| `log_disable`         | -                                                      | Disables logging.                                       |
| `log_status`          | -                                                      | Returns whether logging is active.                      |
| `log_enable`          | -                                                      | Enables logging if the logging table is configured.     |
| `log_config`          | `$table = "mysqllogging", $section = "", $logall = false` | Configures logging settings including table name, section, and whether to log all messages. |
| `stop_on_error`       | `$bool = false`                                       | Configures whether to stop execution on error.          |
| `display_on_error`    | `$bool = false`                                       | Configures whether to display errors.                  |

### Miscellaneous

| Method/Function       | Parameters                                             | Description                                              |
|-----------------------|--------------------------------------------------------|----------------------------------------------------------|
| `log`                 | `$output, $sqlerror, $exception, $init, $boolsuccess, $nolog = false` | Logs the error details to the database or file if logging is enabled. |
| `handler`             | `$excecution, $exception, $init, $nolog = false`       | Handles the execution and error logging.               |

### Primary

#### `select(...)`

Retrieves data from the database based on the provided query. It supports fetching single or multiple rows.

| Method          | `select` |
|-----------------|----------|
| **Parameters**  | `string $query` <br> SQL query to execute <br> `bool $multiple` <br> Whether to fetch multiple rows (default: `false`) <br> `mixed $bindarray` <br> Array of binding parameters or `false` for direct query <br> `int $fetch_type` <br> Type of result array (e.g., `MYSQLI_ASSOC`, `MYSQLI_NUM`) |
| **Return Value** | Returns an array of results if successful; `false` if failed |


#### `query(...)`

Executes a general query (e.g., INSERT, DELETE, etc.) and returns the result set.

| Method          | `query` |
|-----------------|---------|
| **Parameters**  | `string $query` <br> SQL query to execute <br> `mixed $bindarray` <br> Array of binding parameters or `false` for direct query |
| **Return Value** | Returns the result set object if successful; `false` if failed |

#### `update(...)`

Executes an update statement and returns the number of affected rows.

| Method          | `update` |
|-----------------|----------|
| **Parameters**  | `string $query` <br> SQL query to execute <br> `mixed $bindarray` <br> Array of binding parameters or `false` for direct query |
| **Return Value** | Number of affected rows if successful; `false` if failed |

#### `insert(...)`

Inserts a new record into a specified table and returns the ID of the inserted record.

| Method          | `insert` |
|-----------------|----------|
| **Parameters**  | `string $table` <br> Name of the table <br> `array $array` <br> Associative array of field names and values <br> `mixed $bindarray` <br> Array of binding parameters or `false` for direct query |
| **Return Value** | Inserted ID if successful; `false` if failed |


## Binding Information

If `$bindarray` is provided for secure data transmission via mysql buffer:

| `bindarray` Format | Description                                |
|--------------------|--------------------------------------------|
| `Array[X]["value"]` | Value to be bound to the query              |
| `Array[X]["type"]`  | Data type of the value (`s` = string, `i` = integer, `d` = double, `b` = blob) |