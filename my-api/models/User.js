// models/user.js
class UserModel {
  constructor(db) {
    this.collection = db.collection("users");
  }

  // Equivalente al pre('save') de Mongoose
  async create(userData) {
    const hashedPassword = await bcrypt.hash(userData.password, 10);

    const newUser = {
      username: userData.username,
      email: userData.email,
      password: hashedPassword,
      createdAt: new Date(),
    };

    return await this.collection.insertOne(newUser);
  }

// Método para asegurar que los índices únicos existan
  async createIndexes() {
    await this.collection.createIndex({ username: 1 }, { unique: true });
    await this.collection.createIndex({ email: 1 }, { unique: true });
  }
}
module.exports = UserModel;
