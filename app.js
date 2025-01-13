const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const dotenv = require('dotenv');
const indoprovinsiRoutes = require('./routes/indoprovinsi');
const port = 5001;

// Load environment variables
dotenv.config();

// Create an Express application
const app = express();

// Middleware
console.log('Middleware JSON dan CORS diaktifkan');
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors());

// Define a root route
app.get('/', (req, res) => {
    console.log('Root route diakses');
    res.send('Welcome to the indoProvinsi REST API :)');
});

// Import Routes
app.use('/api/provinsi', indoprovinsiRoutes);

// Test a simple route
app.get('/test', (req, res) => {
    res.send('Server is working!');
});

// Error handling in Express
app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).send('Something broke!');
});

// Catch-all route for 404
app.use((req, res) => {
    res.status(404).json({ error: 'Rute tidak ditemukan' });
});

// Start server
const PORT = process.env.PORT || 5001;
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
