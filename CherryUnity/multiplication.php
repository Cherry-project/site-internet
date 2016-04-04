<?php 
 // Désactiver le rapport d'erreurs
    error_reporting(0);
    session_start() ?>
<!doctype html>
<html>
    
<head>
    <?php include 'head.php' ?>
    <title>Multiplication</title>
</head>

<body>
    <?php include 'nav.php' ?>
    <h1 style="margin-left: 27px;">S'entrainer aux multiplications</h1>
    
    <form id='frmope' style="" >
        <div id='zonimpression'>
            <div id="zonprincipal"  class="fs19">
                <br />
                <div  style='position:relative;min-height:200px;'>
                    <!--
                    <div id='zoneclavierexercice' style='position:absolute;right:5px;top:0px;'>
                        <div class='noprint clavier' style="padding:4px;">
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 7&#013;dans la zone active" onclick='ajouterchaine("7",0);' >7</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 8&#013;dans la zone active" onclick='ajouterchaine("8",0);' >8</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 9&#013;dans la zone active" onclick='ajouterchaine("9",0);' >9</div>
                            <br />
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 4&#013;dans la zone active" onclick='ajouterchaine("4",0);' >4</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 5&#013;dans la zone active" onclick='ajouterchaine("5",0);' >5</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 6&#013;dans la zone active" onclick='ajouterchaine("6",0);' >6</div>
                            <br />
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 1&#013;dans la zone active" onclick='ajouterchaine("1",0);' >1</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 2&#013;dans la zone active" onclick='ajouterchaine("2",0);' >2</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 3&#013;dans la zone active" onclick='ajouterchaine("3",0);' >3</div>
                            <br />
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer le chiffre 0&#013;dans la zone active" onclick='ajouterchaine("0",0);' >0</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Insérer une virgule &#013;dans la zone active" onclick='ajouterchaine(".",0);' >.</div>
                            <div type="button" class="cmd cmdgris bouton_clavier"   title="Effacer" onclick='remplacercaracteres("",1)' >C</div>
                            <br />
                            <div type="button" class="cmd cmdgris bouton_clavier" style="width:128px;font-size:14px;"  title="Passer à la case suivante" onclick='passerfocuschampelevesuivant(idtxtcourant);'>Suivant</div> 
                        </div>
                    </div>
                    -->
                    <table border='0' width="75%">
                        <tr valign="top">
                            <td width="50%">
                                <table>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>0</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_0'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='1'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>1</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'><input type='text' name='txtele[]' id='eleb_1'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='2'/></td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>2</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'><input type='text' name='txtele[]' id='eleb_2'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='3'/></td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>3</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'><input type='text' name='txtele[]' id='eleb_3'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='4'/></td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>4</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_4'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='5'/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width='50%'>
                                <table>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>5</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'><input type='text' name='txtele[]' id='eleb_5'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='6'/></td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>6</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_6'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='7'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="pointjaune">&#8226;</span></td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>7</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_7'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='8'/></td></tr><tr><td><span class="pointjaune">&#8226;</span>
                                        </td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>8</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_8'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='9'/></td></tr><tr><td><span class="pointjaune">&#8226;</span>
                                        </td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>9</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_9'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='10'/></td></tr><tr><td><span class="pointjaune">&#8226;</span>
                                        </td>
                                        <td align='center' width='30'>2</td>
                                        <td>x</td>
                                        <td align='center' width='30'>10</td>
                                        <td style="padding-right: 10px;">=</td>
                                        <td align='center'>
                                            <input type='text' name='txtele[]' id='eleb_10'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='11'/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
		<div class="zonesolutiondessous" style="visibility:hidden;display:none;margin-top:10px;" id="zonsolution0">
			<div class="lignecorrige" style="cursor:pointer" onClick='$("#zoncorrige").slideToggle("slow");'>Voir le corrigé</div>
			<div id='zoncorrige'  style='display:none;'>
			<table border='0' width="75%"><tr valign="top"><td width="50%">
                                    <table>
                                        <tr>
                                            <td>
                                                <span class="pointjaune">&#8226;</span>
                                            </td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>0</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'><input type='text' name='txtsol[]' id='solb_0'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='1'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>1</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_1'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='2'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>2</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'><input type='text' name='txtsol[]' id='solb_2'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='3'/></td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>3</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_3'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='4'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>4</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_4'   class='saisienombre' style='text-align:center' maxlength='1'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='5'/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width='50%'>
                                    <table>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>5</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_5'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='6'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>6</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_6'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='7'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>7</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_7'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='8'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>8</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_8'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='9'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>9</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_9'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='10'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="pointjaune">&#8226;</span></td>
                                            <td align='center' width='30'>2</td>
                                            <td>x</td>
                                            <td align='center' width='30'>10</td>
                                            <td style="padding-right: 10px;">=</td>
                                            <td align='center'>
                                                <input type='text' name='txtsol[]' id='solb_10'   class='saisienombre' style='text-align:center' maxlength='2'  onfocus='factivation(this.id);saisieinit(this.id)' onkeyup='testmaxlengthpasserfocus(event.keyCode,this.id,"");'  tabindex='11'/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
			</div>
                </div>
            </div>
        </div>
        <div id="zonboutons" align='center' style="margin-top:10px;margin-bottom:15px;" >
            <div id='zonetousboutons'>
                <!--<a id='btncorriger' name='btncorriger' class='cmd cmdvert'  title="Corriger l'exercice"  onclick="document.getElementById('zonboutons').style.display='block';lancercorriger02('var tblsolution=new Array();tblsolution[§{eleb_0§{]=§{%0§{;tblsolution[§{eleb_1§{]=§{%2§{;tblsolution[§{eleb_2§{]=§{%4§{;tblsolution[§{eleb_3§{]=§{%6§{;tblsolution[§{eleb_4§{]=§{%8§{;tblsolution[§{eleb_5§{]=§{%10§{;tblsolution[§{eleb_6§{]=§{%12§{;tblsolution[§{eleb_7§{]=§{%14§{;tblsolution[§{eleb_8§{]=§{%16§{;tblsolution[§{eleb_9§{]=§{%18§{;tblsolution[§{eleb_10§{]=§{%20§{;')"  tabindex='11' >
                    <img src='images/exercice_corriger.png' height='30px' />
                    <span id='spancorriger' >Corriger</span>
                </a>-->
                <button type="button" class="btn btn-success">Corriger</button>
                <span id="zoneboutons" >
                    <!--<a class='cmd' name='btnrecommencer' id='btnrecommencer' onclick='$("#btnvaliderpage").click();' >
                        <img src='images/exercice_recommencer.png' height='30px' /> Recommencer</a>-->
                    <button type="button" class="btn btn-info">Recommencer</button>
                </span>
            </div>
        </div>
        <input type='button' name='btnvaliderpage' id='btnvaliderpage' style='display:none;' value='Valider page'  onclick="fctvalidertables('exercice-mathematiques-calculs-tables-multiplication.html',2104,'modele12_tables.php');" />
    </form>
    
    <form name="frmresultats">
        <input type="hidden" id="txtrubno" value="2104">
        <input type="hidden" id="txtdifficulte" value="">
        <input type="hidden" id="txtcorrection" value="">
        <input type="hidden" id="txtinfo" value="Table de 2 - Ordonnée ">
        <input type="hidden" id="txtparametres" value="*tables=2*ordre=1*inverse=0*plusieurs=0">
        <input type="hidden" id="txtexono" value="0"><input type="hidden" id="txtnbftes" value="">
    </form>  
    
    
    
    <?php include 'footer.php' ?>

</body>
</html>