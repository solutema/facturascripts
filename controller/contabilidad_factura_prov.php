<?php
/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2012  Carlos Garcia Gomez  neorazorx@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'model/factura_proveedor.php';

class contabilidad_factura_prov extends fs_controller
{
   public $factura;
   
   public function __construct()
   {
      parent::__construct('contabilidad_factura_prov', 'Factura de proveedor', 'contabilidad', FALSE, FALSE);
   }
   
   protected function process()
   {
      $this->ppage = $this->page->get('contabilidad_facturas_prov');
      
      if( isset($_GET['id']) )
      {
         $this->factura = new factura_proveedor();
         $this->factura = $this->factura->get($_GET['id']);
         if($this->factura)
         {
            $this->page->title = $this->factura->codigo;
            $this->buttons[] = new fs_button('b_ver_asiento', 'ver asiento', $this->factura->asiento_url(), 'button', 'img/zoom.png');
         }
      }
   }
   
   public function url()
   {
      if($this->factura)
         return $this->factura->url();
      else
         return $this->page->url();
   }
}

?>