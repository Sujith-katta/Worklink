<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Worker Registration - WorkLink</title>
  <style>
    body {
      background: #e2e2e2;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px;
    }

    .title {
      position: absolute;
      top: 20px;
      font-size: 30px;
      font-weight: bold;
      color: #3b3be0;
      text-shadow: 1px 1px #999;
    }

    .label-side {
      position: absolute;
      left: 60px;
      top: 180px;
      font-size: 28px;
      font-weight: 500;
      color: #222;
      writing-mode: vertical-lr;
      transform: rotate(180deg);
    }

    .form-container {
      background: white;
      border-radius: 20px;
      padding: 30px;
      width: 400px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      margin-top: 80px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    select {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .gender-group, .capacity-group {
      display: flex;
      justify-content: space-between;
      margin-top: 8px;
    }

    .gender-group label,
    .capacity-group label {
      flex: 1;
      text-align: center;
      background: #eee;
      padding: 8px;
      margin: 0 4px;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="radio"],
    input[type="checkbox"] {
      display: none;
    }

    .gender-group input[type="radio"]:checked + label,
    .capacity-group input[type="radio"]:checked + label {
      background: #3b3be0;
      color: white;
    }

    .photo-upload {
      display: flex;
      align-items: center;
      margin-top: 12px;
    }

    .photo-upload input {
      margin-left: 10px;
    }

    .submit-btn {
      width: 100%;
      margin-top: 20px;
      background-color: #3b3be0;
      color: white;
      padding: 10px;
      border: none;
      font-weight: bold;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="title">WorkLink</div>
<div class="label-side">Worker Registration</div>

<div class="form-container">
  <h2>Create a new account</h2>
  <form action="register_worker_process.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="First Name" required>
    <input type="text" name="surname" placeholder="Surname" required>

    <input type="number" name="age" placeholder="Age" required>

    <label>Gender:</label>
    <div class="gender-group">
      <input type="radio" id="female" name="gender" value="Female" required><label for="female">Female</label>
      <input type="radio" id="male" name="gender" value="Male"><label for="male">Male</label>
      <input type="radio" id="others" name="gender" value="Others"><label for="others">Others</label>
    </div>

    <input type="text" name="phone" placeholder="Phone No." required>
    <input type="email" name="email" placeholder="Email" required>

    <label>Select work Type:</label>
    <select name="work_type" required>
      <option value="">--Select--</option>
      <option value="Electrician">Electrician</option>
      <option value="Plumber">Plumber</option>
      <option value="Carpenter">Carpenter</option>
      <option value="Mechanic">Mechanic</option>
      <!-- Add more types -->
    </select>

    <label>Capacity:</label>
    <div class="capacity-group">
      <input type="radio" id="small" name="capacity" value="Small" required><label for="small">Small</label>
      <input type="radio" id="medium" name="capacity" value="Medium"><label for="medium">Medium</label>
      <input type="radio" id="large" name="capacity" value="Large"><label for="large">Large</label>
      <input type="radio" id="all" name="capacity" value="All"><label for="all">All</label>
    </div>

    <label>Profile Photo:</label>
    <div class="photo-upload">
      <input type="file" name="profile_photo" accept="image/*" required>
    </div>

    <label>Place:</label>
    <input type="text" name="place" placeholder="Enter your location" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Upload work Images:</label>
    <input type="file" name="work_images[]" multiple accept="image/*">

    <button type="submit" class="submit-btn">Register</button>
  </form>
</div>

</body>
</html>
