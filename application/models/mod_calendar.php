<?php 
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Mod_calendar extends CI_model{
	
			
			public function showacc_calendar($perPage, $offSet){
					$query = $this
						->db
						->select('*')
						->from('acc_calendar')
						->join('accommodation','accommodation.acc_id = acc_calendar.accomodations_id' )
						->join ('calendar_available','calendar_available.ca_id  = acc_calendar.calendar_available_id')
						->limit($perPage, $offSet)
						->get();
					return $query;
				}
			public function detail_accom($get_id){
				$query = $this
						->db
						->select('*')
						->from('acc_calendar')
						->join('accommodation','accommodation.acc_id = acc_calendar.accomodations_id')
						
						->join('photo','photo.photo_id = accommodation.photo_id')
						->join('classification','classification.clf_id = accommodation.classification_id')
						->join('festival','festival.ftv_id = accommodation.acc_ftv_id')
						->join('room_types','room_types.rt_id  = accommodation.acc_rt_id')
						
						->join ('calendar_available','calendar_available.ca_id  = acc_calendar.calendar_available_id')
						->where("accca_id ", $get_id)	
						->get();
					return $query;
				}
			
			public function detail_activities($get_id){
				$query = $this
						->db
						->select('*')
						->from('acti_calendar')
						->join('activities','activities.act_id = acti_calendar.activities_id ')
						
						->join('photo','photo.photo_id = activities.photo_id')
						->join('location','location.lt_id  = activities.location_id ')
						->join('festival','festival.ftv_id = activities.act_ftv_id')
						
						->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
						->where("act_id ", $get_id)	
						->get();
					return $query;
				}
			public function detail_transport($get_id){
				$query = $this
						->db
						->select('*')
						->from('tp_calendar')
						->join('transportation','transportation.tp_id = tp_calendar.transport_id')
						->join('photo','photo.photo_id = transportation.photo_id')
						->join('location','location.lt_id  = transportation.tp_pickuplocation ')
						->join('festival','festival.ftv_id = transportation.tp_ftv_id')
						->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
					
						->where("tp_id ", $get_id)	
						->get();
					return $query;
				}
				
			public function detail_extraproducts($get_id){
				$query = $this
						->db
						->select('*')
						->from('extraproduct_calendar')
						->join('extraproduct','extraproduct.ep_id  = extraproduct_calendar.extraproduct_id')
						->join('calendar_available','calendar_available.ca_id = extraproduct_calendar.calendar_available_id')
					
						->where("ep_id ", $get_id)	
						->get();
					return $query;
				}
			public function showacti_calendar($perPage, $offSet){
				$query = $this
						->db
						->select('*')
						->from('acti_calendar')
						->join('activities','activities.act_id = acti_calendar.activities_id ')
						->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
						->limit($perPage, $offSet)
						->get();
			return $query;
			}
			public function showtran_calendar($perPage, $offSet){
					$query = $this
							->db
							->select('*')
							->from('tp_calendar')
							->join('transportation','transportation.tp_id = tp_calendar.transport_id')
							->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
							->limit($perPage, $offSet)
							->get();
					return $query;
				}
			public function showextrapro_calendar($perPage, $offSet){
				   $query = $this
				   			->db
							->select('*')
							->from('extraproduct_calendar')
							->join('extraproduct','extraproduct.ep_id  = extraproduct_calendar.extraproduct_id')
							->join('calendar_available','calendar_available.ca_id = extraproduct_calendar.calendar_available_id')
							->limit($perPage, $offSet)
							->get();
					return $query;
				}
	}