<div align="center">

# 🏍️ Clase `Moto`
### Comparación entre **Java** y **JavaScript**
POO · Constructores · Métodos estáticos

</div>

## ☕ Java

```java
public class Moto {

    // 🔧 Atributos
    public String motor;
    public String marca;

    // Constructor
    public Moto(String motor, String marca) {
        this.motor = motor;
        this.marca = marca;
    }
}
```
# JavaScript
```javascript
class Moto {

    // 🏭 Método estático (Factory)
    static create(motor, marca) {
        return {
            motor,
            marca,
            id: crypto.randomUUID()
        }
    }

    constructor(motor, marca) {
        this.motor = motor;
        this.marca = marca;
    }
}


```


📌 Notas clave

1. constructor() inicializa las propiedades al usar new.

2. static create() permite crear objetos sin instanciar la clase.

3. JavaScript es dinámico y flexible.



# 🧠 Comparación rápida
| Característica      | Java ☕       | JavaScript 🟨             |
| ------------------- | ------------ | ------------------------- |
| Tipado              | Fuerte       | Dinámico                  |
| Constructor         | Obligatorio  | Opcional                  |
| Métodos estáticos   | Sí           | Sí                        |
| Creación de objetos | `new Moto()` | `new` o `static create()` |

<div align="center">
⚡Code is like a motorcycle: powerful, fast and precise

Made with ❤️ by **Mikel Navarro**  
💻 Java · JavaScript · Markdown  
🛠️ Clean Code · POO · Factory Pattern  

🌐 [GitHub](https://github.com/) · [LinkedIn](https://linkedin.com/) · [Portfolio](https://example.com)


© 2025 — All rights reserved


</div>
