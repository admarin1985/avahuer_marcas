<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Producto;
use AppBundle\Util\Util;
use Doctrine\ORM\NoResultException;

/**
 * ProductoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EstructuraRepository extends \Doctrine\ORM\EntityRepository
{
    public function buscar($filtros)
    {
        $contrato = $this->getParam($filtros, 'contrato');
        $puesto = $this->getParam($filtros, 'puesto');
        $marca =  $this->getParam($filtros, 'marca');
        $fecha = $this->getParam($filtros, 'fecha');

        $qb = $this->createQueryBuilder('e');
        $query = $qb->where($qb->expr()->eq(true,true));

        if ($contrato !== null && $contrato !== '') {
            $query->andWhere($qb->expr()->like('e.contrato',':contrato'))
                ->setParameter('contrato', '%' . $contrato . '%');
        }
        if ($puesto !== null && $puesto !== '') {
            $query->andWhere($qb->expr()->like('e.puesto',':puesto'))
                ->setParameter('puesto', '%' . $puesto . '%');
        }
        if ($marca !== null && $marca !== '') {
            $query->andWhere($query->expr()->like('e.marca', ':marca'))
                ->setParameter('marca', '%' . $marca . '%');
        }
//        if ($fecha !== null && $fecha !== '') {
//            $query->andWhere($query->expr()->eq('p.fecha', ':fecha'))
//                ->setParameter('grupo', $fecha);
//        }

        $query->orderBy('e.id', 'ASC');

        try {
            return $query->getQuery()->getArrayResult();
        } catch (NoResultException $e) {
            return array();
        }

    }

    /**
     * Dado un arreglo asociativo y la llave de tipo string obligatoriamente,
     * devolver el valor asociado a la llave
     * hace todas las verificaciones pertinentes para evitar errores
     * devuelve el valor existente en la posición de una llave string en el arreglo o devuelve falso
     * si no se cumplen los requisitos
     * Función muy usada para recojer valores de filtro de un formulario enviado.
     *
     * @param $paramArray
     * @param string $paramStr
     * @return string|object|bool
     */
    private function getParam($paramArray, $paramStr = '')
    {
        try {
            if (is_array($paramArray)
                && isset($paramStr)
                && is_string($paramStr)
                && !empty($paramStr)
                && isset($paramArray[$paramStr])
                && !is_null($paramArray[$paramStr])
                && $paramArray[$paramStr] !== ''
            ) {
                return $paramArray[$paramStr];
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}