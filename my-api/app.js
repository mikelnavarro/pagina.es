var createError = require('http-errors');
var express = require('express');
var path = require('path');
const cookieParser = require('cookie-parser');
const mongodb = require('mongodb');
var logger = require('morgan');
const db = require("./config/db");


const registerRouter = require('./routes/register');
const usersRouter = require('./routes/users');
const PORT = process.env.PORT || 5000;
const app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');


// Middleware
app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/register', registerRouter);
app.use('/users', usersRouter);

// Mensaje de API de prueba
app.get("/", (req, res) => {
  res.send("Bienvenido a mi API");
});
// catch 404 and forward to error handler
app.use(function(req, res, next) {
  next(createError(404));
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});


// Conectar a DB y luego arrancar servidor
db.connectToDatabase()
  .then(() => {
    app.listen(PORT, () => {
      console.log(`Server listening on port ${PORT}`);
    });
  })
  .catch(err => {
    console.error("No se pudo iniciar el servidor:", err);
    process.exit(1);
  });
module.exports = app;
