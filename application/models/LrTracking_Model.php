<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LrTracking_Model extends CI_Model {

	  public function searchData($lrNo, $custName, $consignee, $invoiceNo, $toPlace) {
        $this->db->select('*');
        $this->db->from('lr');
        $this->db->like('LRNO', $lrNo);
        $this->db->like('Consignor', $custName);
        $this->db->like('Consignee', $consignee);
        $this->db->like('InvoiceNo', $invoiceNo);
        $this->db->like('ToPlace', $toPlace);

        $query = $this->db->get();
        return $query->result();

    }


    public function insert_data($data) {
        $this->db->insert('custfeedback', $data);
    }





public function getLRData($lrno) {
    try {
         $query=$this->db->select(
            'lr.id, lr.LRNO, lr.LRDate, lr.LRDT, lr.ArriveDate, lr.FromPlace, lr.ToPlace, ' .
            'lr.PayBasis, lr.Consignor, lr.Consignee, lr.ConsigneeMar, lr.PkgsNo, lr.ActualWeight, ' .
            'lr.DocketTotal, lr.FRTRate, lr.Status, lr.InvoiceNo, lr.Origin, lr.CoastCenter, ' .
            'lr.Destination, lr.CurrentLocation, lr.NextLocation, lr.BookingType, lr.ConsignorId, ' .
            'lr.ConsigneeId, lr.FRTType, lr.DRS_THCNO, lr.ArriveQty, lr.CancelReason, lr.CancelDate, ' .
            'lr.CancelUser, lr.MOT, lr.ServiceType, lr.PickupDelType, lr.ConsigneeAdd, ' .
            'lr.ConsigneeAddMar, lr.ConsigneeMob, lr.DocCharge, lr.Hamali, lr.OtherCharge, ' .
            'lr.DoordelCharge, lr.ExcesswtCharge, lr.CSGSTRate, lr.CSGSTAmount, lr.CreatedBy, ' .
            'lr.FreightCharge, lr.BillingParty, lr.ConsignorAdd, lr.ConsignorMob, lr.EDD, ' .
            'lr.EWBNo, lr.EWBDate AS lr_EWBDate, lr.DeliveredQty, lr.Billgenerate, ' .
            'lr.DeliveryDate, lr.ReturnLR, lr.ManualLRNO, lr.LRedituser, lr.StatementNos, ' .
            'lr.LRHamalis, lr.Paidtype, lr.CPvaluesearch, lr.LSNO AS lr_LSNO, lr.ManifestNo, ' .
            'lr.perbox, ewbill.EWBNo AS ewbill_EWBNo, ewbill.EWBdate, ewbill.EWBExpdate, ' .
            'ewbill.ConsolidateNo, ewbill.LSNO AS ewbill_LSNO, ' .
            'custfeedback.Date AS feedback_Date, custfeedback.PersonName, ' .
            'custfeedback.PersonMobile, custfeedback.Problem, custfeedback.Responce, ' .
            'custfeedback.Feedback, custfeedback.SMSsend, custfeedback.CATEGORY, ' .
            'custfeedback.ClosingFeedback, custfeedback.EntryUser'
        );
        
        $this->db->from('lr');
        $this->db->where('lr.LRNO', $lrno);
        $this->db->join('ewbill', 'lr.LRNO = ewbill.LRNO', 'left');
        $this->db->join('custfeedback', 'lr.LRNO = custfeedback.LRNO', 'left');
        $this->db->group_by('lr.LRNO');
        $query = $this->db->get();
        $result = $query->row_array();

        if (!empty($result)) {
             $query1 = $this->db->query("
                SELECT
                    vtcpod.LRNO,
                    vtcpod.DRSNO,
                    (SELECT ActualWeight FROM LR WHERE LRNO = ?) AS ActualWeight,
                    vtcpod.FreightCharge,
                    SUM(vtcpod.Weight) AS TotalWeight,
                    (vtcpod.FreightCharge / SUM(vtcpod.Weight)) AS FreightPerWeight,
                    ((SELECT ActualWeight FROM LR WHERE LRNO = ?) * (vtcpod.FreightCharge / SUM(vtcpod.Weight))) AS SINGLR_LR_COST,
                    (SELECT DocketTotal FROM LR WHERE LRNO = ?) - ((SELECT ActualWeight FROM LR WHERE LRNO = ?) * (vtcpod.FreightCharge / SUM(vtcpod.Weight))) AS profit_loss,
                    (SELECT DocketTotal FROM LR WHERE LRNO = ?) AS DocketTotal
                FROM
                    vtcpod
                JOIN LR ON vtcpod.LRNO = LR.LRNO
                WHERE
                    vtcpod.DRSNO = lr.DRS_THCNO;
            ", array($lrno, $lrno, $lrno, $lrno, $lrno));

            $result1 = $query1->row_array();

            if (!empty($result1)) {
                $query2 = $this->db->query("
                SELECT
                    vtcpod.LRNO,
                    vtcpod.Cosigner,
                    vtcpod.Path,
                    vtcpod.DRSNO,
                    DATE_FORMAT(vtcpod.DRSdate, '%d-%m-%Y') AS DRSdate,
                    vtcpod.Uploadtime,
                    vtcpod.Place,
                    vtcpod.Qty,
                    vtcpod.Weight,
                    vtcpod.Consignee,
                    DATE_FORMAT(vtcpod.BookingDate, '%d-%m-%Y') AS BookingDate,
                    vtcpod.VehicleNo,
                    vtcpod.DriverName,
                    vtcpod.DriverMobile,
                    vtcpod.VendorName,
                    vtcpod.Delivered,
                    vtcpod.DeliveryDate,
                    vtcpod.StatementNo,
                    DATE_FORMAT(vtcpod.StatementDate, '%d-%m-%Y') AS StatementDate,
                    vtcpod.Canceluser,
                    T2.Remark
                FROM vtcpod
                LEFT JOIN Detention T2 ON vtcpod.LRNO = T2.LRNO
                WHERE vtcpod.LRNO = ?
                GROUP BY vtcpod.DRSNO
            ", array($lrno));

                $result2 = $query2->row_array();



            if (!empty($result2)) {
    $query3 = $this->db->query("
        SELECT t1.`THCNO`, t2.THCdate, `Qty`, `UpdatedQty`, `Reason`, t2.Location, t2.Depot, t2.VehicleNo AS VehicleNothc, t2.DriverName as DriverNamethc, t2.DriverMobile as Drivermobailthc , t2.VendorName AS thcvendor, t2.ArrivalDate, t2.Canceluser AS THCCanceluser,t2.THCArrivaluser, u.`EmpName`
        FROM `LRTHCDetails` t1
        INNER JOIN THC t2 ON t1.`THCNO` = t2.THCNO
        LEFT JOIN (SELECT `UserName`, `EmpName` FROM `users`) u ON t2.THCArrivaluser = u.`UserName`
        WHERE `LRNO` = ?
    ", array($lrno));



                $result3 = $query3->row_array();



                return array_merge($result, $result1, $result2, $result3);
            }
        }
}
        return $result;
    } catch (Exception $e) {
        show_error('Error retrieving data: ' . $e->getMessage(), 500);
    }
}

 public function getByDateRange($startDate, $endDate)
{
    $query = $this->db->query("SELECT t1.id, t1.LRNO, t1.Date, t1.PersonName, t1.PersonMobile, t1.Problem, t1.Responce, t1.Feedback, t2.LRDate,
        t2.Consignor, t2.Consignee, t2.ToPlace, t2.PkgsNo, t2.InvoiceNo, t2.EDD, t2.CancelReason, t2.CancelDate, EntryUser, CATEGORY FROM `CustFeedback` t1 JOIN LR t2 ON t1.`LRNO` = t2.LRNO
        WHERE `Date` BETWEEN ? AND ?", array($startDate, $endDate));
    return $query->result();
}



}