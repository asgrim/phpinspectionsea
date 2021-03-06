<?php

class Exception1 extends \Exception {}
class Exception2 extends \Exception {}
class Exception3 extends \Exception {}

/* transitive, kept in a trait */
interface _Interface {
    /** @throws \Exception1 */
    public function method();
}
abstract class _ClassWithInterface implements _Interface {
    /** @inheritdoc */
    public function <weak_warning descr="Following exceptions annotated, but not thrown: '\Exception1'.">method</weak_warning>() {}
}

/* transitive, kept in a trait */
trait _Trait {
    /** @throws \Exception2 */
    public function <weak_warning descr="Following exceptions annotated, but not thrown: '\Exception2'.">method</weak_warning>() {}
}
abstract class _ClassWithTrait implements _Interface {
    use _Trait;
}

class CasesHolder {
    /**
     * PhpDoc with missing exceptions annotation
     */
    public function one(_ClassWithInterface $one, _ClassWithTrait $two) {
        $one-><weak_warning descr="Throws a non-annotated/unhandled exception: '\Exception1'.">method</weak_warning>();
        $two-><weak_warning descr="Throws a non-annotated/unhandled exception: '\Exception2'.">method</weak_warning>();
    }

    /**
     * PhpDoc with missing exceptions annotation
     * @throws \Exception1
     */
    public function two(_ClassWithInterface $one, _ClassWithTrait $two) {
        $one->method();
        $two-><weak_warning descr="Throws a non-annotated/unhandled exception: '\Exception2'.">method</weak_warning>();
    }
}