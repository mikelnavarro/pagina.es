const Task = require("../model/task");
const { MongoClient } = require("mongodb");

class TaskService {
  static async get() {
    const uri = "mongodb://mongoadmin:secret@localhost:27017";
    const client = new MongoClient(uri);
    try {
      await client.connect();
      const database = client.db("TaskDB");
      const tasksDB = database.collection("tasks");

      // Queries for a movie that has a title value of 'Back to the Future'
      const query = { titulo: "Back to the Future", autor: "jfdjff"};
      const task = await tasks.findOne(query);
      const tasks = await tasksDB.find().toArray();

      return tasks;
    } finally {
      await client.close();
    }
  }

  static getById(id) {}

  static post(marca, modelo, precio) {}

  static delete(id) {}

  static update(id, marca, modelo, precio) {}
}

module.exports = TaskService;
