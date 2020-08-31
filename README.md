# Basic Task Manager  

### Description  
I built this app to learn about Laravel (esp. implementing RESTful APIs).  
**Tech Stack-** Laravel, MySQL
---
### Instructions
#### For running entirely on localhost
1. Please install *composer* and make its installation global. Read [here](https://getcomposer.org/doc/00-intro.md#locally)
2. To install laravel, run in a shell `composer global require laravel/installer`
3. Read about setting composer vendor bin as global [here](https://laravel.com/docs/7.x/installation). This will also be a helper on how to install Laravel.
4. Clone this repo `git clone https://github.com/TipsByPullak/basic_task_manager`
5. cd into this repo `cd basic_task_manager` and run `php artisan serve`
6. See the *API Endpoints* section at the end for reference.
---
### API Endpoints

```
POST /teams
request:

{
  "name":"Platform",
}

response:

{
  "id":"b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
  "name": "Platform",
}
id should be uuid,
name should be string
```

```
GET /teams/:id
response:

{
  "id":"b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
  "name": "Platform"
}
```

```
POST /teams/:id/member
request:
{
	"name": "Vv",
	"email": "venkat.v@razorpay.com"
}
Response:
{
	"id": "b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
	"name": "Vv",
	"email": "venkat.v@razorpay.com"
}
In case email is already associated with someone in the team, throw an error message saying
"Email already associated with a team member"
```

```
DELETE /teams/:id/members/:id2

response:
HTTP 204 No Content
In case there are tasks assigned to the member, show a message saying:
"Member cannot be deleted, please reassign all tasks from this member to someone else before trying again"
```

```
POST /teams/:id/tasks
request:
{
  "title": "Deploy app on stage", //mandatory
  "description" : "We have built a new app which needs to be tested thoroughly", //optional
  "assignee_id": "some member id from the same team", // optional 
  "status": "todo"
}
response:
{
  "id": "2a913e52-81ea-4987-874d-820969a62ea6",
  "title": "Deploy app on stage", //mandatory
  "description" : "We have built a new app which needs to be tested thoroughly", //optional
  "assignee_id": "some member id from the same team", // optional
  "status": "todo" 
}
assignee_id should belong to the same team as the task.  Else raise an error
Status can be todo or done
```

```
GET /teams/:id/tasks/:id2
response:
{
  "id": "2a913e52-81ea-4987-874d-820969a62ea6",
  "title": "Deploy app on stage", //mandatory
  "description" : "We have built a new app which needs to be tested thoroughly", //optional
  "assignee_id": "some member id from the same team", // optional
  "status": "todo" 
}
```

```
PATCH /teams/:id/tasks/:id2
request:
{
  "title": "Deploy app on preprod",//optional
  "description":"new description",//optional
  "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",//optional
  "status": "done"
}
response:
{
  "id": "2a913e52-81ea-4987-874d-820969a62ea6",
  "title": "Deploy app on preprod",//optional
  "description":"new description",//optional
  "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
  "status": "done"
}
assignee_id should belong to the same team as the task.  Else raise an error
Status can be todo or done
```

```
GET /teams/:id/tasks/
response:
[
{
  "id": "2a913e52-81ea-4987-874d-820969a62ea6",
  "title": "Deploy app on preprod",//optional
  "description":"new description",//optional
  "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
  "status": "todo"
},
]
List of all tasks for a team in todo status
```

```
GET /teams/:id/members/:id2/tasks/
response:
[
{
  "id": "2a913e52-81ea-4987-874d-820969a62ea6",
  "title": "Deploy app on preprod",//optional
  "description":"new description",//optional
  "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
  "status": "todo"
},
]
List of all tasks for a member in the team in todo status
```
