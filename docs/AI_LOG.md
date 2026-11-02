# AI Usage Log

## Milestone 1 & Milestone 2

### AI Tools Used
- ChatGPT / Claude: Used for structuring the relational database schema, boilerplate DAO classes, and initial SPA routing logic.

### Prompts Used
1. "Generate a relational MySQL schema for a Student Productivity app with 5 entities: Users, Courses, Tasks, Notes, Habits."
2. "Create a generic PHP PDO BaseDao class with CRUD methods using prepared statements."

### AI Mistakes and Corrective Actions
1. **Raw SQL Injection vulnerability in initial AI query suggestion:**
   - *Issue:* The AI suggested raw string interpolation in a custom search query inside `TaskDao.php`.
   - *Detection:* Code review showed `SELECT * FROM tasks WHERE title LIKE '%$search%'`.
   - *Fix:* Refactored to use PDO parameter binding `$stmt->bindValue()` with positional/named parameters.

2. **Missing foreign key constraint cascade rules:**
   - *Issue:* Deleting a course failed due to foreign key violations in tasks and notes.
   - *Detection:* MySQL error `1451 Cannot delete or update a parent row` during test record cleanup.
   - *Fix:* Added `ON DELETE CASCADE` to foreign keys in `database.sql` for `tasks` and `notes` tables connected to `courses`.