const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'garan_garage'
});

db.connect(err => {
    if (err) throw err;
    console.log('MySQL Connected...');
});

// Owners
app.post('/owners', (req, res) => {
    const { name, phone, email, address } = req.body;
    db.query('INSERT INTO owners (name, phone, email, address) VALUES (?,?,?,?)',
        [name, phone, email, address], (err, result) => {
            if (err) throw err;
            res.json({ message: 'Owner added', id: result.insertId });
        });
});

// Vehicles linked to owners
app.post('/vehicles', (req, res) => {
    const { owner_id, vehicle_model, license_plate, service_date } = req.body;
    db.query('INSERT INTO vehicles (owner_id, vehicle_model, license_plate, service_date) VALUES (?,?,?,?)',
        [owner_id, vehicle_model, license_plate, service_date], (err, result) => {
            if (err) throw err;
            res.json({ message: 'Vehicle added', id: result.insertId });
        });
});

app.get('/vehicles', (req, res) => {
    db.query(`SELECT v.id, o.name AS owner, v.vehicle_model, v.license_plate, v.service_date, v.status 
              FROM vehicles v JOIN owners o ON v.owner_id = o.id`, (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

// Staff
app.post('/staff', (req, res) => {
    const { name, role, phone, email } = req.body;
    db.query('INSERT INTO staff (name, role, phone, email) VALUES (?,?,?,?)',
        [name, role, phone, email], (err, result) => {
            if (err) throw err;
            res.json({ message: 'Staff added', id: result.insertId });
        });
});

app.get('/staff', (req, res) => {
    db.query('SELECT * FROM staff', (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

// Jobs
app.post('/jobs', (req, res) => {
    const { vehicle_id, staff_id, job_description, job_date } = req.body;
    db.query('INSERT INTO jobs (vehicle_id, staff_id, job_description, job_date) VALUES (?,?,?,?)',
        [vehicle_id, staff_id, job_description, job_date], (err, result) => {
            if (err) throw err;
            res.json({ message: 'Job assigned', id: result.insertId });
        });
});

app.get('/jobs', (req, res) => {
    db.query(`SELECT j.id, v.license_plate, s.name AS staff, j.job_description, j.job_date, j.status
              FROM jobs j 
              JOIN vehicles v ON j.vehicle_id = v.id
              JOIN staff s ON j.staff_id = s.id`, (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

app.listen(5000, () => {
    console.log('Server running on port 5000');
});
