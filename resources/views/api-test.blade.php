<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Test - Person</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 { color: #333; }
        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
        button.delete { background: #dc3545; }
        button.delete:hover { background: #c82333; }
        input {
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #output {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            white-space: pre-wrap;
            font-family: monospace;
            font-size: 12px;
            max-height: 400px;
            overflow-y: auto;
        }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: inline-block; width: 80px; }
    </style>
</head>
<body>
    <h1>Person API Test</h1>
    
    <div class="card">
        <h3>Create Person</h3>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" id="name" placeholder="Enter name" value="John Doe">
        </div>
        <div class="form-group">
            <label>Age:</label>
            <input type="number" id="age" placeholder="Enter age" value="25">
        </div>
        <div class="form-group">
            <label>Contact:</label>
            <input type="text" id="contact" placeholder="Enter contact" value="1234567890">
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" id="address" placeholder="Enter address" value="123 Main St">
        </div>
        <button onclick="createPerson()">Create</button>
    </div>

    <div class="card">
        <h3>Get All People</h3>
        <button onclick="getAllPeople()">Get All</button>
    </div>

    <div class="card">
        <h3>Get Person by ID</h3>
        <input type="number" id="personId" placeholder="Enter ID" value="1">
        <button onclick="getPerson()">Get</button>
    </div>

    <div class="card">
        <h3>Update Person</h3>
        <input type="number" id="updateId" placeholder="Enter ID" value="1">
        <input type="text" id="updateName" placeholder="New name" value="Jane Doe">
        <button onclick="updatePerson()">Update</button>
    </div>

    <div class="card">
        <h3>Delete Person</h3>
        <input type="number" id="deleteId" placeholder="Enter ID" value="1">
        <button class="delete" onclick="deletePerson()">Delete</button>
    </div>

    <div class="card">
        <h3>Response Output</h3>
        <div id="output">Click a button to test the API...</div>
    </div>

    <script>
        const apiUrl = '/api/people';

        function output(data) {
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }

        async function createPerson() {
            try {
                const data = {
                    name: document.getElementById('name').value,
                    age: document.getElementById('age').value,
                    contact: document.getElementById('contact').value,
                    address: document.getElementById('address').value
                };
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                output(result);
            } catch (error) {
                output({ error: error.message });
            }
        }

        async function getAllPeople() {
            try {
                const response = await fetch(apiUrl);
                const result = await response.json();
                output(result);
            } catch (error) {
                output({ error: error.message });
            }
        }

        async function getPerson() {
            try {
                const id = document.getElementById('personId').value;
                const response = await fetch(apiUrl + '/' + id);
                const result = await response.json();
                output(result);
            } catch (error) {
                output({ error: error.message });
            }
        }

        async function updatePerson() {
            try {
                const id = document.getElementById('updateId').value;
                const data = { name: document.getElementById('updateName').value };
                const response = await fetch(apiUrl + '/' + id, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                output(result);
            } catch (error) {
                output({ error: error.message });
            }
        }

        async function deletePerson() {
            try {
                const id = document.getElementById('deleteId').value;
                const response = await fetch(apiUrl + '/' + id, {
                    method: 'DELETE'
                });
                const result = await response.json();
                output(result);
            } catch (error) {
                output({ error: error.message });
            }
        }
    </script>
</body>
</html>

