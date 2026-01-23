var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});
const app = express();
const port = 3000;

app.get('/', (req, res) => {
  res.send('Hola Mundo desde mi primera API en Node.js!');
});

app.listen(port, () => {
  console.log(`API escuchando en http://localhost:${port}`);
});
module.exports = router;
