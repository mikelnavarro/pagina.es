<?php
trait ContadorTiempo {
    private $tiempoMinimo;
    private $tiempoMaximo;

    // Accesores
    // Modificadores
    public function setTiempoMinimo(int $minutos) {
        $this->tiempoMinimo = $minutos;
    }

    public function getTiempoMinimo() {
        return $this->tiempoMinimo;
    }

    public function setTiempoMaximo(int $minutos) {
        $this->tiempoMaximo = $minutos;
    }

    public function getTiempoMaximo() {
        return $this->tiempoMaximo;
    }


    // El metodo para calcular si el tiempo es valido
    public function tiempoValido() {
        return $this->horas >= $this->tiempoMinimo && $this->horas <= $this->tiempoMaximo;
    }
}
?>