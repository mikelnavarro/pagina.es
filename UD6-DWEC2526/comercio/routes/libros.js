var express = require("express");
var router = express.Router();
const booksService = require("../services/booksService");

let Libro = require("../public/libro");
const libros = [];
let contador = 0;

router.get("/:id", (req, res) => {
  let libro = libros.filter((x) => x.id == req.params.id);
  if (libro.length === 0) {
    res.status(404).send("Not Found");
  } else {
    res.json(libro);
  }
});
router.get("/", function (req, res, next) {
  res.json(libros);
});

router.post("/", function (req, res, next) {
  const libro = new Libro(
    contador,
    req.body.titulo,
    req.body.autor,
    req.body.annio
  );
  libros.push(libro);
  contador++;
  res.status(201).json(libro);
});

router.put("/:id", function (req, res, next) {
  const updated = booksService.addBook(
    req.body.titulo,
    req.body.autor,
    req.body.annio
  );

  if (!updated) {
    return res.status(404).json({ error: "Moto not found" });
  }

  res.json(updated);
});

router.get("/", function (req, res, next) {
  res.json(booksService.getAllBooks());
});

router.post("/", function (req, res, next) {
  const newBook = booksService.addBook(JSON.parse(req.body));
  res.json(newBook);
});
module.exports = router;
