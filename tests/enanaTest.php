<?php

use PHPUnit\Framework\TestCase;
include './src/Enana.php';

class EnanaTest extends TestCase {
    
    public function testCreandoEnana() {
        #Se probará la creación de enanas vivas, muertas y en limbo y se comprobará tanto la vida como el estado

        $calc = new Enana("Lucia",100);

        $this->assertEquals("Lucia", $calc->getNombre());
        $this->assertEquals(100, $calc->getPuntosVida());
        $this->assertEquals("viva", $calc->getSituacion());
    }
    public function testHeridaLeveVive() {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida suficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es mayor que 0 y además que su situación es viva

        $calc = new Enana("Lucia",100);
        $calc->heridaLeve();
        $this->assertEquals(90, $calc->getPuntosVida());
        $this->assertEquals("viva", $calc->getSituacion());
    }

    public function testHeridaLeveMuere()
    {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida insuficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es menor que 0 y además que su situación es muerta
        $enana = new Enana("lucia", 9);
        $enana->heridaLeve();
        $this->assertEquals("muerta", $enana->getSituacion());
        $this->assertLessThan(0, $enana->getPuntosVida());

    }

    public function testHeridaGrave() {
        #Se probará el efecto de una herida grave a una Enana con una situación de viva.
        #Se tendrá que probar que la vida es 0 y además que su situación es limbo
        
        $calc = new Enana("Lucia",100);
        $calc->heridaGrave();
        $this->assertEquals(0, $calc->getPuntosVida());
        $this->assertEquals("limbo", $calc->getSituacion());
    }
    
    public function testPocimaRevive() {
        #Se probará el efecto de administrar una pócima a una Enana muerta pero con una vida mayor que -10 y menor que 0
        #Se tendrá que probar que la vida es mayor que 0 y que su situación ha cambiado a viva

        $calc = new Enana("Lucia",-5);
        $calc->pocima();
        $this->assertEquals(5, $calc->getPuntosVida());
        $this->assertEquals("viva", $calc->getSituacion());
    }

    public function testPocimaNoRevive() {
        #Se probará el efecto de administrar una pócima a una Enana en el limbo
        #Se tendrá que probar que la vida y situación no ha cambiado

        $calc = new Enana("Lucia",0);
        $calc->pocima();
        $this->assertEquals(0, $calc->getPuntosVida());
        $this->assertEquals("limbo", $calc->getSituacion());
    }

    public function testPocimaExtraLimbo() {
        #Se probará el efecto de administrar una pócima Extra a una Enana en el limbo.
        #Se tendrá que probar que la vida es 50 y la situación ha cambiado a viva.

        $calc = new Enana("Lucia",0);
        $calc->pocimaExtra();
        $this->assertEquals(50, $calc->getPuntosVida());
        $this->assertEquals("viva", $calc->getSituacion());
    }
}
?>