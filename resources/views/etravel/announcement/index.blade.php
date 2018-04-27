@extends("etravel.layout.main") @section("content")
<div class="container">
	@include("etravel.layout.pagebar")
	<div class="page-content-inner">
		<div class="inbox row">
			
			
			
                <div class="col-md-12">
                    <div class="portlet box grey-cararra">
                        <div class="portlet-title">
                            <div class="caption"></div>
                            <div class="actions">
                                <div id="btnAnnouncementControl"></div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form id="FormAnnouncement" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form">
                                <input type="hidden" id="_CountryID" name="_CountryID" value="<?php echo $CountryID ?>">
                                <input type="hidden" id="_AnnouncementID" name="_AnnouncementID" value="<?php echo $SelectedAnnouncementID ?>">
                                <input type="hidden" id="_IsSave" name="_IsSave" value="0">
                                <input type="hidden" id="_SiteID" name="_SiteID" value="<?php echo $SiteID ?>">
                                <input type="hidden" id="_RowStatus" name="_RowStatus" value="1">

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="AnnouncementCountry" class="control-label col-xs-3 text-right">Country:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <?php echo CountryList($CountryID, 'AnnouncementCountry', $DisableCountrySite, 'announcement-control') ?> 
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="SiteList" class="control-label col-xs-3 text-right">Site:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <?php echo SiteList($SiteID, $CountryID, 'announcement-control', $DisableCountrySite) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="AnnouncementType" class="control-label col-xs-3 text-right">Type:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <?php echo cboGetAnnouncementType($SelectedAnnouncementTypeID, 'AnnouncementType', true, 'announcement-control') ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="AnnouncementType" class="control-label col-xs-3 text-right">Description:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <input type="text" id="AnnouncementDescription" disabled name="AnnouncementDescription" class="form-control announcement-control" value="<?php echo $AnnouncementDescription ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="AnnouncementDateEffectivity" class="control-label col-xs-3 text-right" style="padding-left: 0px;">Effectivity Date:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <div id='AnnouncementDateEffectivity' name="AnnouncementDateEffectivity" class="leave-date announcement-control"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="AnnouncementDateExpired" class="control-label col-xs-3 text-right" style="padding-left: 0px;">Expiration Date:</label>
                                        <div class="col-xs-8" style="padding-bottom: 3px">
                                            <div id='AnnouncementDateExpired' name="AnnouncementDateExpired" class="leave-date announcement-control"></div>   
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="EmploymentStatusList" class="control-label col-xs-3 text-left">Announcement:</label>
                                        <textarea id="Announcement" name="Announcement" class="form-control leave-control"><?php echo $Announcement ?></textarea>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <div class="panel panel-default table-responsive">
                                            <div class="panel-heading" style="height:30px;"><span style="font-size: 14px;">List of Announcement</span><span id="LeaveAttachment" data-toggle="popover" data-trigger="hover" data-content="Click this icon to expand/hide" data-placement="bottom" title="Expand/Hide" class="expander glyphicon glyphicon-plus"></span></div>
                                            <div id="LeaveAttachmentDetails" class="panel-body" style="display: initial;font-size: 12px;padding: 0 0 0 0">
                                                <table id="tblAnnouncement" class="table table-bordered table-condensed table-hand">
                                                    <thead>
                                                        <tr class="btn-primary">
                                                            <th style="display: none">AnnouncementID</th>
                                                            <th style="display: none">SiteID</th>
                                                            <th style="display: none">AnnouncementTypeID</th>
                                                            <th style="display: none">Announcement</th>
                                                            <th style="text-align: center;width: 30px">#</th>
                                                            <th style="text-align: left;width: 200px">AnnouncementType</th>
                                                            <th style="text-align: left;">Description</th>
                                                            <th style="text-align: center;width: 100px">Effectivity Date</th>
                                                            <th style="text-align: center;width: 100px">Expiration Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php echo spViewListOfAnnouncement($SelectedAnnouncementID, $SiteID) ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
			
			
		</div>
	</div>
</div>
