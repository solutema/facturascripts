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

require_once 'base/fs_model.php';

class agente extends fs_model
{
   public $coddepartamento;
   public $email;
   public $fax;
   public $telefono;
   public $codpostal;
   public $codpais;
   public $provincia;
   public $ciudad;
   public $direccion;
   public $porcomision;
   public $irpf;
   public $dnicif;
   public $nombre;
   public $apellidos;
   public $codagente;
   
   public function __construct($a=FALSE)
   {
      parent::__construct('agentes');
      if($a)
      {
         $this->coddepartamento = $a['coddepartamento'];
         $this->email = $a['email'];
         $this->fax = $a['fax'];
         $this->telefono = $a['telefono'];
         $this->codpostal = $a['codpostal'];
         $this->codpais = $a['codpais'];
         $this->provincia = $a['provincia'];
         $this->ciudad = $a['ciudad'];
         $this->direccion = $a['direccion'];
         $this->porcomision = $a['porcomision'];
         $this->irpf = floatval($a['irpf']);
         $this->dnicif = $a['dnicif'];
         $this->nombre = $a['nombre'];
         $this->apellidos = $a['apellidos'];
         $this->codagente = $a['codagente'];
      }
      else
      {
         $this->coddepartamento = NULL;
         $this->email = NULL;
         $this->fax = NULL;
         $this->telefono = NULL;
         $this->codpostal = NULL;
         $this->codpais = NULL;
         $this->provincia = NULL;
         $this->ciudad = NULL;
         $this->direccion = NULL;
         $this->porcomision = NULL;
         $this->irpf = NULL;
         $this->dnicif = '';
         $this->nombre = '';
         $this->apellidos = '';
         $this->codagente = NULL;
      }
   }
   
   public function get_fullname()
   {
      return $this->nombre." ".$this->apellidos;
   }
   
   public function get_new_codigo()
   {
      $cod = $this->db->select("SELECT MAX(codagente::integer) as cod FROM ".$this->table_name.";");
      if($cod)
         return 1 + intval($cod[0]['cod']);
      else
         return 1;
   }
   
   public function url()
   {
      return "index.php?page=admin_agentes#".$this->codagente;
   }

   protected function install()
   {
      return "";
   }
   
   public function exists()
   {
      if( is_null($this->codagente) )
         return FALSE;
      else
         return $this->db->select("SELECT * FROM ".$this->table_name." WHERE codagente='".$this->codagente."';");
   }
   
   public function save()
   {
      if( $this->exists() )
      {
         $sql = "UPDATE ".$this->table_name." SET nombre = '".$this->nombre."', apellidos = '".$this->apellidos.
                "', dnicif = '".$this->dnicif."', telefono = '".$this->telefono."', email = '".$this->email."'
                 WHERE codagente = '".$this->codagente."';";
      }
      else
      {
         $sql = "INSERT INTO ".$this->table_name." (codagente,nombre,apellidos,dnicif,telefono,email) VALUES
                 ('".$this->codagente."','".$this->nombre."','".$this->apellidos."','".$this->dnicif."','".$this->telefono."','".$this->email."');";
      }
      return $this->db->exec($sql);
   }
   
   public function delete()
   {
      return $this->db->exec("DELETE FROM ".$this->table_name." WHERE codagente = '".$this->codagente."';");
   }
   
   public function get($cod)
   {
      $a = $this->db->select("SELECT * FROM ".$this->table_name." WHERE codagente='".$cod."';");
      if($a)
         return new agente($a[0]);
      else
         return FALSE;
   }
   
   public function all()
   {
      $listagentes = array();
      $agentes = $this->db->select("SELECT * FROM ".$this->table_name." ORDER BY nombre ASC;");
      if($agentes)
      {
         foreach($agentes as $a)
            $listagentes[] = new agente($a);
      }
      return $listagentes;
   }
}

?>