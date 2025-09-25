<!DOCTYPE html>
<html>
<head>
    <title>Debug Company Creation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Debug Company Creation</h1>
    
    <div style="margin: 20px;">
        <h2>Test Database Connection</h2>
        <button onclick="testDatabase()">Test Database</button>
        <div id="dbResult"></div>
    </div>
    
    <div style="margin: 20px;">
        <h2>Test Company Creation</h2>
        <button onclick="testCreateCompany()">Create Test Company</button>
        <div id="createResult"></div>
    </div>
    
    <div style="margin: 20px;">
        <h2>Simple Company Creation</h2>
        <a href="/simple-create-company" target="_blank">
            <button>Create Simple Company (Direct)</button>
        </a>
    </div>
    
    <div style="margin: 20px;">
        <h2>Simple Company Form (Minimal)</h2>
        <form id="simpleForm" action="{{ route('employer.companies.store') }}" method="POST">
            @csrf
            <div style="margin: 10px 0;">
                <label>Company Name (Required):</label><br>
                <input type="text" name="name" value="Simple Company {{ time() }}" required style="width: 300px; padding: 5px;">
            </div>
            <div style="margin: 10px 0;">
                <label>Email (Required):</label><br>
                <input type="email" name="email" value="simple{{ time() }}@example.com" required style="width: 300px; padding: 5px;">
            </div>
            <button type="submit" style="padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer;">Create Company</button>
        </form>
        <div id="simpleResult"></div>
    </div>
    
    <div style="margin: 20px;">
        <h2>Full Company Form</h2>
        <form id="testForm" action="{{ route('employer.companies.store') }}" method="POST">
            @csrf
            <div>
                <label>Company Name:</label>
                <input type="text" name="name" value="Test Company {{ time() }}" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" value="test{{ time() }}@example.com" required>
            </div>
            <div>
                <label>Industry:</label>
                <input type="text" name="industry" value="Technology">
            </div>
            <div>
                <label>Logo URL (optional):</label>
                <input type="url" name="logo" value="" placeholder="https://example.com/logo.png">
            </div>
            <div>
                <label>Phone:</label>
                <input type="text" name="phone" value="+1234567890">
            </div>
            <div>
                <label>Website:</label>
                <input type="url" name="website" value="https://example.com">
            </div>
            <div>
                <label>Founded Year:</label>
                <input type="number" name="founded_year" value="2020">
            </div>
            <div>
                <label>Description:</label>
                <textarea name="description">Test company description</textarea>
            </div>
            <div>
                <label><input type="checkbox" name="featured" value="1"> Featured</label>
            </div>
            <div>
                <label><input type="checkbox" name="verified" value="1"> Verified</label>
            </div>
            <button type="submit">Submit Form</button>
        </form>
        <div id="formResult"></div>
    </div>

    <script>
        function testDatabase() {
            fetch('/test-db-companies')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('dbResult').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                })
                .catch(error => {
                    document.getElementById('dbResult').innerHTML = '<pre>Error: ' + error.message + '</pre>';
                });
        }

        function testCreateCompany() {
            fetch('/test-create-company')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('createResult').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                })
                .catch(error => {
                    document.getElementById('createResult').innerHTML = '<pre>Error: ' + error.message + '</pre>';
                });
        }

        // Simple form handler
        document.getElementById('simpleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            console.log('Simple form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Simple form response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Simple form response data:', data);
                document.getElementById('simpleResult').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                
                if (data.success) {
                    Swal.fire('Success!', 'Company created successfully!', 'success');
                } else {
                    Swal.fire('Error!', data.message || 'Something went wrong', 'error');
                }
            })
            .catch(error => {
                console.error('Simple form error:', error);
                document.getElementById('simpleResult').innerHTML = '<pre>Error: ' + error.message + '</pre>';
            });
        });

        // Full form handler
        document.getElementById('testForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            console.log('Form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                document.getElementById('formResult').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                
                if (data.success) {
                    Swal.fire('Success!', data.message, 'success');
                } else {
                    Swal.fire('Error!', data.message || 'Something went wrong', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('formResult').innerHTML = '<pre>Error: ' + error.message + '</pre>';
            });
        });
    </script>
</body>
</html>