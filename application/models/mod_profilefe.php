<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Mod_Profilefe extends MU_Model{
        
               public function pass_profilefe($passegnger_id){
                   $query = $this->db->select('*')
                           ->from('passenger')
                           ->where('passenger.pass_deleted', 0)
                           ->where('pass_id',$passegnger_id)
                           ->get();
                   return $query;
               }
               public function passenger_bookedform($passegnger_id){
                   $select = $this->db->select('*')
                           ->from('booking')
                           ->join('passenger_booking','booking.bk_id  =  passenger_booking.pbk_bk_id', 'left')
                           ->join('passenger','passenger.pass_id  =  passenger_booking.pbk_pass_id ', 'left')
                           ->join('sale_customize','sale_customize.salecus_bk_id = booking.bk_id', 'left')                          
                           ->join('sale_packages','sale_packages.salepk_bk_id = booking.bk_id', 'left')
                           ->join('customize_conjection','customize_conjection.cuscon_id = sale_customize.salecus_cuscon_id', 'left')
                           ->join('package_conjection','package_conjection.pkcon_id = sale_packages.salepk_pkcon_id', 'left')
                           ->where('passenger.pass_deleted', 0)
                           ->where('passenger_booking.pbk_pass_id',$passegnger_id)
                           ->get();
                  return $select;
              }
              public function upgrate_profile($passegnger_id, $fname,$lname,$email,$phonenum,$address,$company,$gender,$get_txtStatus){
                  $data = array(
                        'pass_fname' => $fname,
                        'pass_lname' => $lname,
                        'pass_email' => $email,
                        'pass_phone' => $phonenum,
                        'pass_address' => $address,
                        'pass_company' => $company,
                        'pass_gender' => $gender,
                        'pass_status' => $get_txtStatus,
                        'pass_deleted' => 0,
                );
                $this->db->where('pass_id', $passegnger_id);
                return $this->db->update('passenger', $data);
              }
       
	}


