DELIMITER $$

DROP PROCEDURE IF EXISTS `ncir_krisanthium`.`SP_simKOP` $$
CREATE PROCEDURE `ncir_krisanthium`.`SP_simKOP`(
    IN noGID text
)
BEGIN
drop table ncir_krisanthium.simkop;

    CREATE TABLE IF NOT EXISTS ncir_krisanthium.simkop
    AS
     SELECT h.docno, h.docdate, h.sodocno, h.pono, w.sodocno as so_wo, w.docno as wo_no, s.docno as so_no,
        d.materialcode, d.qtydelivered, h.information
        FROM sim_krisanthium.goodsissueh h
        left join sim_krisanthium.workorderh w on h.sodocno = w.sodocno
        left join sim_krisanthium.salesorderh s on h.sodocno = s.docno
        left join sim_krisanthium.salesorderd d on s.docno = d.docno
        where h.docno = noGID;


    SELECT docno, docdate, sodocno, pono, so_wo, wo_no, so_no, materialcode, qtydelivered, information
        FROM simkop;

END $$

DELIMITER ;