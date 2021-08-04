<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Hjqs_Mentions_Legales
 * @subpackage Hjqs_Mentions_Legales/public/partials
 */
?>
<?php
$options = get_option('hjqs_mentions_legales_options');
$nom_entreprise                  = $options['cgv_proprietaire'] ?: 'Inconnu';
$nom_entreprise_forme_juridique  = $nom_entreprise . ' ' . $options['cgv_forme_juridique'] ?: 'Forme juridique inconnue';
$forme_juridique                 = $options['cgv_forme_juridique'] ?: 'Forme juridique inconnue';
$capital_social                  = $options['cgv_capital_social'] ?: 'Capital social inconnu';
$adresse                         = $options['cgv_adresse'] ?: 'Adresse inconnue';
$rcs                             = $options['cgv_rcs'] ?: 'RCS inconnu';
$siret                           = $options['cgv_siret'] ?: 'Numéro SIRET inconnu';
$responsable_publication         = $options['cgv_responsable'] ?: 'Responsable inconnu';
$responsable_publication_contact = $options['cgv_responsable_contact'] ?: '';
$procedure_remboursement = $options['cgv_conditions_retour'] ?: 'Procedure inconnue';
$duree_annulation = $options['cgv_indisponibilite_produit_temps'] ?: 'Durée inconnue';
$prestataires = $options['cgv_moyens_de_paiement'];
$produits_sans_retour = $options['cgv_produit_sans_retour'] ?: '';
$adresse_retour = $options['cgv_adresse_retour'] ?: 'Adresse inconnue';
$procedure_retour = $options['cgv_conditions_retour'] ?: '';
$duree_concervation_donnees = $options['cgv_duree_de_concervation_des_donnees'] ?: 'Durée inconnue';

?>
<div class="hjqs-cgv">
    <h2>Préambule</h2>
        <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site <?php echo $nom_entreprise; ?> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi :</p>
    <ul>
        <li>Propriétaire du site : <?php echo $nom_entreprise_forme_juridique ?></li>
        <li>Siège social : <?php echo $adresse ?></li>
        <li>Numéro SIRET : <?php echo $siret ?></li>
        <li>Numéro d'immatriculation RCS : <?php echo $rcs ?></li>
        <li>Capital Social : <?php echo $capital_social ?></li>
        <li>Responsable : <?php echo $responsable_publication ?> <?php echo $responsable_publication_contact ?></li>
    </ul>
    <p>Ci-après dénommé le « Vendeur » ou la « Société » peut être jointe avec les informations suivantes : <?php echo $responsable_publication_contact ?> </p>
    <p>La personne physique ou morale procédant à l’achat de produits ou services de la société, ci-après, « l’Acheteur », ou « le Client » à été exposé et convenu ce qui suit</p>
    <p>Le Vendeur est éditeur de Produits et Services de <?php echo $nom_entreprise ?> à destination de consommateurs, commercialisés par l’intermédiaire de ses sites Internet (<?php bloginfo('url') ?>). La liste et le descriptif des biens et services proposés par la Société peuvent être consultés sur les sites susmentionnés.</p>

    <h2>1. Objet</h2>
    <p>Les présentes Conditions Générales de Vente déterminent les droits et obligations des parties dans le cadre de la vente en ligne de Produits ou Services proposés par le Vendeur.</p>

    <h2>2. Dispositions générales</h2>
    <p>Les présentes Conditions Générales de Vente (CGV) régissent les ventes de Produits ou de Services, effectuées au travers des sites Internet de la Société, et sont partie intégrante du Contrat entre l’Acheteur et le Vendeur. Elle sont pleinement opposable à l'Acheteur qui les a accepté avant de passer commande.</p>
    <p>Le Vendeur se réserve la possibilité de modifier les présentes, à tout moment par la publication d’une nouvelle version sur son site Internet. Les CGV applicables alors sont celles étant en vigueur à la date du paiement (ou du premier paiement en cas de paiements multiples) de la commande. Ces CGV sont consultables sur le site Internet de la Société à l'adresse suivante : <?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>.</p>
    <p>La Société s’assure également que leur acceptation soit claire et sans réserve en mettant en place une case à cocher et un clic de validation. Le Client déclare avoir pris connaissance de l’ensemble des présentes Conditions Générales de Vente, et le cas échéant des Conditions Particulières de Vente liées à un produit ou à un service, et les accepter sans restriction ni réserve.</p>
    <p>Le Client reconnaît qu’il a bénéficié des conseils et informations nécessaires afin de s’assurer de l’adéquation de l’offre à ses besoins.</p>
    <p>Le Client déclare être en mesure de contracter légalement en vertu des lois françaises ou valablement représenter la personne physique ou morale pour laquelle il s’engage. Sauf preuve contraire les informations enregistrées par la Société constituent la preuve de l’ensemble des transactions.</p>

    <h2>3. Prix</h2>
    <p>Les prix des produits vendus au travers des sites Internet sont indiqués en Euros hors taxes et précisément déterminés sur les pages de descriptifs des Produits. Ils sont également indiqués en euros toutes taxes comprises (TVA + autres taxes éventuelles) sur la page de commande des produits, et hors frais spécifiques d'expédition.</p>
    <p>Pour tous les produits expédiés hors Union européenne et/ou DOM-TOM, le prix est calculé hors taxes automatiquement sur la facture. Des droits de douane ou autres taxes locales ou droits d'importation ou taxes d'état sont susceptibles d'être exigibles dans certains cas. Ces droits et sommes ne relèvent pas du ressort du Vendeur. Ils seront à la charge de l'acheteur et relèvent de sa responsabilité (déclarations, paiement aux autorités compétentes, etc.). Le Vendeur invite à ce titre l'acheteur à se renseigner sur ces aspects auprès des autorités locales correspondantes.</p>
    <p>La Société se réserve la possibilité de modifier ses prix à tout moment pour l’avenir. Les frais de télécommunication nécessaires à l’accès aux sites Internet de la Société sont à la charge du Client. Le cas échéant également, les frais de livraison.</p>

    <h2>4. Conclusion du contrat en ligne</h2>

    Conformément aux dispositions de l'article 1127-1 du Code civil, le Client doit suivre une série d’étapes pour conclure le contrat par voie électronique pour pouvoir réaliser sa commande :
    <ul>
        <li>Information sur les caractéristiques essentielles du Produit</li>
        <li>Choix du Produit</li>
        <li>Indication des coordonnées essentielles du Client (identification, email, adresse, etc.)</li>
        <li>Acceptation des présentes Conditions Générales de Vente</li>
        <li>Vérification des éléments de la commande (formalité du double clic) et, le cas échéant, correction des erreurs. Avant de procéder à sa confirmation, l'Acheteur a la possibilité de vérifier le détail de sa commande, son prix, et de corriger ses éventuelles erreur, ou annuler sa commande. La confirmation de la commande emportera formation du présent contrat.</li>
        <li>Vérification des instructions pour le paiement, paiement des produits, puis livraison de la commande. Le Client recevra confirmation par courrier électronique du paiement de la commande, ainsi qu’un accusé de réception de la commande la confirmant.</li>
    </ul>
    <p>Le client disposera pendant son processus de commande de la possibilité d'identifier d'éventuelles erreurs commises dans la saisie des données et de les corriger. La langue proposé pour la conclusion du contrat est la langue française.</p>
    <p>Les modalités de l'offre et des conditions générales de vente sont renvoyées par email à l'acheteur lors de la commande et archivées sur le site web du Vendeur. Le cas échéant, les règles professionnelles et commerciales auxquelles l'auteur de l'offre entend se soumettre sont consultables dans la rubrique "règles annexes" des présentes CGV, consultables sur le site du Vendeur à l'adresse suivante : <?php echo $responsable_publication_contact ?>.</p>
    <p>L'archivage des communications, de la commande, des détails de la commande, ainsi que des factures est effectué sur un support fiable et durable de manière constituer une copie fidèle et durable conformément aux dispositions de l'article 1360 du code civil. Ces informations peuvent être produits à titre de preuve du contrat.</p>
    <p>Pour les produits livrés, la livraison se fera à l’adresse indiquée par le Client. Aux fins de bonne réalisation de la commande, le Client s’engage à fournir ses éléments d’identification véridiques.</p>
    <p>Le Vendeur se réserve la possibilité de refuser la commande, par exemple pour toute demande anormale, réalisée de mauvaise foi ou pour tout motif légitime.</p>

    <h2>5. Produits et services</h2>
    <p>Les caractéristiques essentielles des biens, des services et leurs prix respectifs sont mis à disposition de l’acheteur sur les sites Internet de la société, de même, le cas échéant, que le mode d'utilisation du produit. Conformément à l'article L112-1 du Code la consommation, le consommateur est informé, par voie de marquage, d'étiquetage, d'affichage ou par tout autre procédé approprié, des prix et des conditions particulières de la vente et de l'exécution des services avant toute conclusion du contrat de vente. Dans tous les cas, le montant total dû par l'Acheteur est indiqué sur la page de confirmation de la commande. Le prix de vente du produit est celui en vigueur indiqué au jour de la commande, celui-ci ne comportant par les frais de ports facturés en supplément. Ces éventuels frais sont indiqués à l'Achteur lors du process de vente, et en tout état de cause au moment de la confirmation de la commande. Le Vendeur se réserve la possibilité de modifier ses prix à tout moment, tout en garantissant l'application du prix indiqué au moment de la commande.</p>
    <p>Lorsque les produits ou services ne sont pas exécuté immédiatement, une information claire est donnée sur la page de présentation du produit quant aux dates de livraison des produits ou services. Le client atteste avoir reçu un détail des frais de livraison ainsi que les modalités de paiement, de livraison et d’exécution du contrat, ainsi qu'une information détaillée relative à l'identité du vendeur, ses coordonnées postales, téléphoniques et électroniques, et à ses activités dans le contexte de la présente vente. Le Vendeur s’engage à honorer la commande du Client dans la limite des stocks de Produits disponibles uniquement. A défaut, le Vendeur en informe le Client ; si la commande a été passée, et à défaut d'accord avec le Client sur une nouvelle date de livraison, le Vendeur rembourse le client.</p>
    <p>Les informations contractuelles sont présentées en détail et en langue française. Les parties conviennent que les illustrations ou photos des produits offerts à la vente n’ont pas de valeur contractuelle. La durée de validité de l’offre des Produits ainsi que leurs prix est précisée sur les sites Internet de la Société, ainsi que la durée minimale des contrats proposés lorsque ceux-ci portent sur une fourniture continue ou périodique de produits ou services. Sauf conditions particulières, les droits concédés au titre des présentes le sont uniquement à la personne physique signataire de la commande (ou la personne titulaire de l’adresse email communiqué).</p>

    <h2>6. Conformité</h2>
    <p>Conformément à l'article L.411-1 du Code de la consommation, les produits et les services offert à la vente au travers des présentes CGV répondent aux prescriptions en vigueur relatives à la sécurité et à la santé des personnes, à la loyauté des transactions commerciales et à la protection des consommateurs. Indépendamment de toute garantie commerciale, le Vendeur reste tenu des défauts de conformité et des vices cachés du produit.</p>
    <p>Conformément à l'article L.217-4, le vendeur livre un bien conforme au contrat et répond des défauts de conformité existant lors de la délivrance. Il répond également des défauts de conformité résultant de l'emballage, des instructions de montage ou de l'installation lorsque celleci a été mise à sa charge par le contrat ou a été réalisée sous sa responsabilité.</p>
    <p>Conformément aux dispositions légales en matière de conformité et de vices cachés (art. 1641 c. civ.), le Vendeur rembourse ou échange les produits défectueux ou ne correspondant pas à la commande. Le remboursement peut être demandé de la manière suivante : <?php echo $procedure_remboursement ?></p>

    <h2>7. Clause de réserve de propriété</h2>
    <p>Les produits demeurent la propriété de la Société jusqu’au complet paiement du prix.</p>

    <h2>8. Modalités de livraison</h2>
    <p>Les produits sont livrés à l'adresse de livraison qui a été indiquée lors de la commande et dans les délais indiqués. Ces délais ne prenent pas en compte le délai de préparation de la commande.</p>
    <p>Lorsque le Client commande plusieurs produits en même temps ceux-ci peuvent avoir des délais de livraison différents</p>
    <p>En cas de retard de livraison, le Client dispose de la possibilité de résoudre le contrat dans les conditions et modalités définies à l’Article L 138-2 du Code de la consommation. Le Vendeur procède alors au remboursement du produit et aux frais « aller » dans les conditions de l’Article L 138-3 du Code de la consommation. Le Vendeur met à disposition un point de contact téléphonique (coût d’une communication locale à partir d’un poste fixe) indiqué dans l’email de confirmation de commande afin d'assurer le suivi de la commande.</p>
    <p>Le Vendeur rappelle qu’au moment où le Client pend possession physiquement des produits, les risques de perte ou d’endommagement des produits lui sont transférés. Il appartient au Client de notifier au transporteur toute réserves sur le produit livré.</p>

    <h2>9. Disponibilité et présentation </h2>
    <p>En cas d’indisponibilité d’un article pour une période supérieure à <?php echo $duree_annulation?> jours ouvrables, vous serez immédiatement prévenu des délais prévisibles de livraison et la commande de cet article pourra être annulée sur simple demande. Le Client pourra alors demander un avoir pour le montant de l’article ou son remboursement intégral et l'annulation de la commande.</p>

    <h2>10. Paiement</h2>
    <p>Le paiement est exigible immédiatement à la commande, y compris pour les produits en précommande. Le Client peut effectuer le règlement par carte de paiement ou chèque bancaire. Les cartes émises par des banques domiciliées hors de France doivent obligatoirement être des cartes bancaires internationales (Mastercard ou Visa).Le paiement sécurisé en ligne par carte bancaire est réalisé par nos prestataires de paiement. Les informations transmises sont chiffrées dans les règles de l’art et ne peuvent être lues au cours du transport sur le réseau.</p>
    <p>Nos préstataires de paiement :</p>
    <ul>
        <?php foreach ($prestataires as $prestataire_key => $prestataire) : ?>
        <li><?php echo $prestataire ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Une fois le paiement lancé par le Client, la transaction est immédiatement débitée après vérification des informations. Conformément aux dispositions du Code monétaire et financier, l’engagement de payer donné par carte est irrévocable. En communiquant ses informations bancaires lors de la vente, le Client autorise le Vendeur à débiter sa carte du montant relatif au prix indiqué. Le Client confirme qu’il est bien le titulaire légal de la carte à débiter et qu’il est légalement en droit d’en faire usage. En cas d’erreur, ou d’impossibilité de débiter la carte, la Vente est immédiatement résolue de plein droit et la commande annulée.</p>

    <h2>11. Délai de rétractation</h2>
    <p>Conformément aux dispositions de l'article L 221-5 du Code de la consommation, l'Acheteur dispose du droit de se rétracter sans donner de motif, dans un délai de quatorze (14) jours à la date de réception de sa commande.</p>
    <p>Le droit de rétractation peut être exercé en contactant la Société de la manière suivante : <?php echo $responsable_publication_contact ?>. Nous informons les Clients que conformément aux dispositions des articles L. 221-18 à L. 221-28 du Code de la consommation, ce droit de rétractation ne peut être exercé pour <?php echo $produits_sans_retour ?> </p>
    <p>En cas d’exercice du droit de rétractation dans le délai susmentionné, le prix du ou des produits achetés et les frais d’envoi seront remboursés, les frais de retour restant à la charge du Client.</p>
    <p>Les retours des produits sont à effectuer dans leur état d'origine et complets (emballage, accessoires, notice, etc.)</p>
    <p>Les retours doivent si possible être accompagnés d’une copie du justificatif d'achat. Conformément aux dispositions légales, vous trouverez ci-après le formulaire-type de rétractation à nous adresser à l’adresse suivante : <?php echo $adresse_retour ?>.</p>
    <p>Procédure de remboursement : <?php echo $procedure_retour ?></p>

    <h2>12. Garanties</h2>
    <p>Conformément à la loi, le Vendeur assume les garanties suivantes : de conformité et relative aux vices cachés des produits. Le Vendeur rembourse l'acheteur ou échange les produits apparemment défectueux ou ne correspondant pas à la commande effectuée. La demande de remboursement doit s'effectuer de la manière suivante : <?php echo $procedure_retour ?></p>
    <p>Le Vendeur rappelle que le consommateur :</p>
    <ul>
        <li>Dispose d'un délai de 2 ans à compter de la délivrance du bien pour agir auprès du Vendeur.</li>
        <li>Qu'il peut choisir entre le remplacement et la réparation du bien sous réserve des conditions prévues par les dispositions susmentionnées. (apparemment défectueux ou ne correspondant)</li>
        <li>Qu'il est dispensé d'apporter la preuve l’existence du défaut de conformité du bien durant les six mois suivant la délivrance du bien.</li>
        <li>Que, sauf biens d’occasion, ce délai sera porté à 24 mois à compter du 18 mars 2016</li>
        <li>Que le consommateur peut également faire valoir la garantie contre les vices cachés de la chose vendue au sens de l’article 1641 du code civil et, dans cette hypothèse, il peut choisir entre la résolution de la vente ou une réduction du prix de vente (dispositions des articles 1644 du Code Civil).</li>
    </ul>

    <h2>13. Réclamations et médiation</h2>
    <p>Le cas échéant, l’Acheteur peut présenter toute réclamation en contactant la société au moyen des coordonnées suivantes : <?php echo $responsable_publication_contact ?></p>
    <p>Conformément aux dispositions des art. L. 611-1 à L. 616-3 du Code de la consommation, le consommateur est informé qu'il peut recourir à un médiateur de la consommation dans les conditions prévues par le titre Ier du livre VI du code de la consommation.</p>
    <p>En cas d'échec de la demande de réclamation auprès du service client du Vendeur, ou en l'absence de réponse dans un délai de deux mois, le consommateur peut soumettre le différent à un médiateur qui tentera en toute indépendance de rapprocher les parties en vue d'obtenir une solution amiable.</p>

    <h2>14. Résolution du contrat</h2>
    <p>La commande peut être résolue par l'acheteur par lettre recommandée avec demande d'avis de réception dans les cas suivants</p>
    <ul>
        <li>Livraison d'un produit non conforme aux caractéristiques de la commande</li>
        <li>Livraison dépassant la date limite fixée lors de la commande ou, à défaut de date, dans les trente jours suivant le paiement </li>
        <li>De hausse du prix injustifiée ou de modification du produit. Dans ces cas, l'acheteur peut exiger le remboursement de l'acompte versé majoré des intérêts calculés au taux légal à partir de la date d'encaissement de l'acompte.</li>
    </ul>

    <h2>15. Droits de propriété intellectuelle </h2>
    <p>Les marques, noms de domaines, produits, logiciels, images, vidéos, textes ou plus généralement toute information objet de droits de propriété intellectuelle sont et restent la propriété exclusive du vendeur. Aucune cession de droits de propriété intellectuelle n’est réalisée au travers des présentes CGV. Toute reproduction totale ou partielle, modification ou utilisation de ces biens pour quelque motif que ce soit est strictement interdite.</p>

    <h2>16. Force majeure</h2>
    <p>L’exécution des obligations du vendeur au terme des présentes est suspendue en cas de survenance d’un cas fortuit ou de force majeure qui en empêcherait l’exécution. Le vendeur avisera le client de la survenance d’un tel évènement dès que possible.</p>

    <h2>17. Nullité et modification du contrat</h2>
    <p>Si l’une des stipulations du présent contrat était annulée, cette nullité n’entraînerait pas la nullité des autres stipulations qui demeureront en vigueur entre les parties. Toute modification contractuelle n’est valable qu’après un accord écrit et signé des parties.</p>

    <h2>18. Protection des données personnelles</h2>
    <p>Conformément au Règlement 2016/679 du 27 avril 2016 relatif à la protection des personnes physiques à l'égard du traitement des données à caractère personnel et à la libre circulation de ces données, le Vendeur met en place un traitement de données personnelles qui a pour finalité la vente et la livraison de produits et services définis au présent contrat. L'Acheteur est informé des éléments suivants : </p>
    <ul>
        <li>L'identité et les coordonnées du responsable du traitement et, le cas échéant, du représentant du responsable du traitement : le Vendeur, tel qu'indiqué en haut des présentes CGV</li>
        <li>Les coordonnées du délégué à la protection des données : <?php echo $responsable_publication_contact ?></li>
        <li>Les destinataires ou les catégories de destinataires des données à caractère personnel, s'ils existent, sont les suivantes :
            <ul>
                <li>Le responsable du traitement</li>
                <li>Les services en charge du marketing</li>
                <li>Les services en charge de la sécurité informatique</li>
                <li>Le service en charge de la vente, de la livraison et de la commande</li>
                <li>Les sous-traitant intervenants dans les opérations de livraison et de vente</li>
                <li>Toute autorité légalement autorisée à accéder aux données personnelles en question</li>
            </ul>
        </li>
        <li>La durée de conservation des données : <?php echo $duree_concervation_donnees ?></li>
        <li>La personne concernée dispose du droit de demander au responsable du traitement l'accès aux données à caractère personnel, la rectification ou l'effacement de celles-ci</li>
        <li> La personne concernée a le droit d'introduire une réclamation auprès d'une autorité de contrôle</li>
    </ul>
    <p>Les informations demandées lors de la commande sont nécessaires à l'établissement de la facture (obligation légale) et la livraison des biens commandés, sans quoi la commande ne pourras pas être passée. Aucune décision automatisée ou profilage n'est mis en oeuvre au travers du processus de commande.</p>

    <h2>19. Droit applicable et clauses</h2>
    <p>Toutes les clauses figurant dans les présentes conditions générales de vente, ainsi que toutes les opérations d’achat et de vente qui y sont visées, seront soumises au droit français.</p>
    <p>La nullité d'une clause contractuelle n'entraîne pas la nullité des présentes conditions générales de vente.</p>

    <h2>20. Information des consommateurs </h2>
    <p>Aux fins d'information des consommateurs, les dispositions du code civil et du code de la consommation sont reproduites ci-après :</p>
    <p>Aricle 1641 du Code civil : Le vendeur est tenu de la garantie à raison des défauts cachés de la chose vendue qui la rendent impropre à l'usage auquel on la destine, ou qui diminuent tellement cet usage que l'acheteur ne l'aurait pas acquise, ou n'en aurait donné qu'un moindre prix, s'il les avait connus.</p>
    <p>Aricle 1648 du Code civil : L'action résultant des vices rédhibitoires doit être intentée par l'acquéreur dans un délai de deux ans à compter de la découverte du vice. Dans le cas prévu par l'article 1642-1, l'action doit être introduite, à peine de forclusion, dans l'année qui suit la date à laquelle le vendeur peut être déchargé des vices ou des défauts de conformité apparents.</p>
    <p>Article L. 217-4 du Code de la consommation : Le vendeur livre un bien conforme au contrat et répond des défauts de conformité existant lors de la délivrance. Il répond également des défauts de conformité résultant de l'emballage, des instructions de montage ou de l'installation lorsque celle-ci a été mise à sa charge par le contrat ou a été réalisée sous sa responsabilité.</p>
    <p>Article L. 217-5 du Code de la consommation : Le bien est conforme au contrat : 1° S'il est propre à l'usage habituellement attendu d'un bien semblable et, le cas échéant : - s'il correspond à la description donnée par le vendeur et possède les qualités que celui-ci a présentées à l'acheteur sous forme d'échantillon ou de modèle ; - s'il présente les qualités qu'un acheteur peut légitimement attendre eu égard aux déclarations publiques faites par le vendeur, par le producteur ou par son représentant, notamment dans la publicité ou l'étiquetage ; 2° Ou s'il présente les caractéristiques définies d'un commun accord par les parties ou est propre à tout usage spécial  recherché par l'acheteur, porté à la connaissance du vendeur et que ce dernier a accepté.</p>
    <p>Article L. 217-12 du Code de la consommation : L'action résultant du défaut de conformité se prescrit par deux ans à compter de la délivrance du bien.</p>
    <p>Article L. 217-16 du Code de la consommation : Lorsque l'acheteur demande au vendeur, pendant le cours de la garantie commerciale qui lui a été consentie lors de l'acquisition ou de la réparation d'un bien meuble, une remise en état couverte par la garantie, toute période d'immobilisation d'au moins sept jours vient s'ajouter à la durée de la garantie qui restait à courir. Cette période court à compter de la demande d'intervention de l'acheteur ou de la mise à disposition pour réparation du bien en cause, si cette mise à disposition est postérieure à la demande d'intervention.</p>
</div>
