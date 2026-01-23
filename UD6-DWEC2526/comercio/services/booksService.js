const books = [
  { title: "Book A", autor: "jf", anio: 1900 },
  { title: "Book A", autor: "jf", anio: 1900 },
];
function getAllBooks() {
  return books;
}

function getBookById(id) {
  return books.find((b) => b.id === id);
}

function addBook(book) {
  book.title;
  book.autor;
  book.anio;
  books.push(book);
  return book;
}

module.exports = {
  getAllBooks,
  getBookById,
  addBook,
};
