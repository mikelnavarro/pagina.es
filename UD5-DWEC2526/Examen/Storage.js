import { Grid } from "./Grid.js";
import { Jugador } from "./Jugador.js";
export class Storage {
  saveConfig(arrayConfig) {
    localStorage.setItem("arrayConfig", JSON.stringify(arrayConfig));
  }

  save(listaUsers) {
    localStorage.setItem("listaUsers", JSON.stringify(listaUsers));
  }
  loadFormFromLocalStorage() {
    const data = JSON.parse(localStorage.getItem("arrayConfig"));

    if (data) {
      return data.map((u) => {
        const grid = Grid.create(u.filas,u.columnas,u.trampas);
        return grid;
      });
    } else {
      return [];
    }
  }

  getUsuario() {
    return listaUsers.map(
      (elemento) =>
        Jugador.create(
          elemento.puntos,
          elemento.vidas
        )
    );
  }
  clearUser() {
    localStorage.removeItem("listaUsers");
  }
}
