// routes/register.js
const express = require('express');
const router = express.Router();
const { ObjectId } = require('mongodb');
const User = require('../models/User');


router.post('/', async (req, res) => {
  try {
    const { username, email, password } = req.body;
    
    const database = db.getDatabase();
    const userModel = new User(database);

    const existingUser = await userModel.findByEmail(email);
    if (existingUser) {
      return res.status(400).json({ message: 'Email already exists' });
    }

    await userModel.create({ username, email, password });
    res.status(201).json({ message: 'User registered successfully' });
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Registration failed' });
  }
});

module.exports = router;
