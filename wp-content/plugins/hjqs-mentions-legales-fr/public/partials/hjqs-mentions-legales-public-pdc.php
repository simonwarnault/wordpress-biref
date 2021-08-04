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
$user_can_subscribe   = $options['pdc_user_can_subscribe'] === 'Non' ? false : true;
$user_can_submit_form   = $options['pdc_user_can_submit_form'] === 'Non' ? false : true;
$user_can_purcharge   = $options['pdc_user_can_purcharge'] === 'Non' ? false : true;
$user_can_publish   = $options['pdc_user_can_publish'] === 'Non' ? false : true;

$duree_concervation_donnees   = $options['pdc_duree_de_concervation_des_donnees'] ?: 'Durée inconnue';
$cookies_services   = $options['pdc_outils_stats'];

?>
<div class="hjqs-pdc">
    <h2>1. Introduction</h2>
    <p>La confidentialité des visiteurs de notre site web est très importante à nos yeux, et nous nous engageons à la protéger. Cette politique détaille ce que nous faisons de vos informations personnelles.
Consentir à notre utilisation de cookies en accord avec cette politique lors de votre première visite de notre site web nous permet d’utiliser des cookies à chaque fois que vous consultez notre site.</p>

    <h2>2. Source</h2>
    <p>Ce document a été créé grâce à un modèle de SEQ Legal (seqlegal.com)</p>

    <h2>3. Collecte d’informations personnelles</h2>
    <p>Les types d’informations personnelles suivants peuvent collectés, stockés et utilisés :</p>

    <ul>
        <li>Des informations à propos de votre ordinateur, y compris votre adresse IP, votre localisation géographique, le type et la version de votre navigateur, et votre système d’exploitation ;</li>
        <li>Des informations sur vos visites et votre utilisation de ce site web y compris la source référente, la durée de la visite, les pages vues, et les chemins de navigation de sites web ;</li>
	    <?php if ( $user_can_subscribe === true ) : ?>
            <li>Des informations comme votre adresse e-mail, que vous nous fournissez lors de votre inscription au site ;</li>
            <li>Des informations que vous saisissez quand vous créez un profil sur notre site web comme votre nom, votre photo de profil, votre genre, votre date de naissance, votre situation amoureuse, vos intérêts et vos loisirs, votre parcours scolaire et votre parcours professionnel ;</li>
	        <li>Toute autre information personnelle que vous nous communiquez.</li>
        <?php endif; ?>
	    <?php if ( $user_can_submit_form === true ) : ?>
            <li>Des informations comme votre nom et votre adresse e-mail, que vous saisissez pour souscrire à nos e-mails et/ou newsletters ;</li>
	    <?php endif; ?>
        <li>Des informations que vous saisissez quand vous utilisez les services de notre site web ;</li>
        <li>Des informations générées lors de l’utilisation de notre site, y compris quand, à quelle fréquence et sous quelles circonstances vous l’utilisez ;</li>
	    <?php if ( $user_can_purcharge === true ) : ?>
            <li>Des informations relatives aux achats que vous faites, aux services que vous utilisez ou aux transactions que vous effectuez sur notre site, qui incluent votre nom, adresse, numéro de téléphone, adresse e-mail et informations bancaires ;</li>
	    <?php endif; ?>
	    <?php if ( $user_can_publish === true ) : ?>
            <li>Des informations que vous publiez sur notre site web dans l’intention de les publier sur internet, et qui incluent votre identifiant, vos photos de profil et le contenu de vos publications ;</li>
	        <li>Des informations contenues dans toutes les communications que vous nous envoyez par e-mail ou sur notre site web, y compris leurs contenus et leurs métadonnées ;</li>
        <?php endif; ?>
        <li>Avant de nous divulguer des informations personnelles concernant une autre personne, vous devez obtenir le consentement de ladite personne en ce qui concerne la divulgation et le traitement de ces informations personnelles selon les termes de cette politique</li>
    </ul>

    <h2>4. Utilisation de vos informations personnelles</h2>
    <p>Les informations personnelles qui nous sont fournies par le biais de notre site web seront utilisées dans les objectifs décrits dans cette politique ou dans les pages du site pertinentes. Nous pouvons utiliser vos informations personnelles pour:</p>
    <ul>
        <li>Administrer notre site web et notre entreprise ;</li>
        <li>Personnaliser notre site web pour vous ;</li>
        <li>Permettre votre utilisation des services proposés sur notre site web ;</li>
        <li>Vous envoyer les marchandises achetées sur notre site ;</li>
        <li>Vous fournir les services achetés sur notre site ;</li>
        <li>Vous envoyer des relevés, des factures et des rappels de paiement, et collecter vos paiements ;</li>
        <li>Vous envoyer des communications commerciales non relatives au marketing ;</li>
        <li>Vous envoyer des notifications par e-mail que vous avez expressément demandées ;</li>
        <li>Vous envoyer notre newsletter par mail, si vous l’avez demandé (vous pouvez nous informer à tout moment de votre volonté de ne plus recevoir notre newsletter) ;</li>
        <li>Vous envoyer des communications marketing relatives à notre entreprise ou à des entreprises tierces sélectionnées avec soin qui selon nous pourraient vous intéresser, sous forme de publication, ou si vous avez expressément donné votre accord, par e-mail ou technologie similaire (vous pouvez nous informer à tout moment de votre volonté de ne plus recevoir de communications marketing) ;</li>
        <li>Fournir des informations statistiques à propos de nos utilisateurs à des tierces parties (sans que ces tierces parties puissent identifier d’utilisateur individuel avec ces informations) ;</li>
        <li>Traiter les demandes et les réclamations relatives à votre site web effectuées par vous ou vous concernant ;</li>
        <li>Maintenir la sécurité de notre site web et empêcher la fraude ;</li>
        <li>Vérifier le respect des conditions générales qui régissent l’utilisation de notre site web (y compris surveiller les messages privés envoyés par le biais du service de messagerie privé de notre site web) ;</li>
    </ul>

    <p>Si vous soumettez des informations personnelles sur notre site web dans le but de les publier, nous les publierons et pourrons utiliser ces informations conformément aux autorisations que vous nous accordez.</p>
    <p>Sans votre consentement explicite, nous ne fournirons pas vos informations personnelles à des tierces parties pour leur marketing direct, ni celui d’autres tierces parties.</p>
    <p>Quand vous laissez un commentaire sur notre site web, les données inscrites dans le formulaire de commentaire, mais aussi votre adresse IP et l’agent utilisateur de votre navigateur sont collectés pour nous aider à la détection des commentaires indésirables.</p>
    <p>Une chaîne anonymisée créée à partir de votre adresse de messagerie (également appelée hash) peut être envoyée au service Gravatar pour vérifier si vous utilisez ce dernier. Les clauses de confidentialité du service Gravatar sont disponibles ici : <a target="_blank" title="Automattic" href="https://automattic.com/privacy/">https://automattic.com/privacy/</a>. Après validation de votre commentaire, votre photo de profil sera visible publiquement à coté de votre commentaire.</p>
    <p>Si vous êtes un utilisateur ou une utilisatrice enregistré·e et que vous téléversez des images sur le site web, nous vous conseillons d’éviter de téléverser des images contenant des données EXIF de coordonnées GPS. Les visiteurs de votre site web peuvent télécharger et extraire des données de localisation depuis ces images.</p>

    <h2>5. Divulgation de vos informations personnelles</h2>
    <p>Nous pouvons divulguer vos informations personnelles à n’importe lequel de nos employés, dirigeants, assureurs, conseillers professionnels, agents, fournisseurs, ou sous-traitants dans la mesure où cela est raisonnablement nécessaire aux fins énoncées dans cette politique.</p>
    <p>Nous pouvons divulguer vos informations personnelles à n’importe quel membre de notre groupe d’entreprises (cela signifie nos filiales, notre société holding ultime et toutes ses filiales) dans la mesure où cela est raisonnablement nécessaire aux fins énoncées dans cette politique.</p>
    <p>Nous pouvons divulguer vos informations personnelles :</p>
    <ul>
        <li>Dans la mesure où nous sommes tenus de le faire par la loi ;</li>
        <li>Dans le cadre de toute procédure judiciaire en cours ou à venir ;</li>
        <li>Pour établir, exercer ou défendre nos droits légaux (y compris fournir des informations à d’autres à des fins de prévention des fraudes et de réduction des risques de crédit) ;</li>
        <li>À l’acheteur (ou acheteur potentiel) de toute entreprise ou actif en notre possession que nous souhaitons (ou envisageons de) vendre ;</li>
        <li>À toute personne que nous estimons raisonnablement faire partie intégrante d’un tribunal ou autre autorité compétente pour la divulgation de ces informations personnelles si, selon notre opinion, un tel tribunal ou une telle autorité serait susceptible de demander la divulgation de ces informations personnelles.</li>
        <li>Sauf disposition contraire de la présente politique, nous ne transmettrons pas vos informations personnelles à des tierces parties.</li>
    </ul>

    <h2>6. Transferts internationaux de données</h2>
    <p>Les informations que nous collectons peuvent être stockées, traitées et transférées dans tous les pays dans lesquels nous opérons, afin de nous permettre d’utiliser les informations en accord avec cette politique.</p>
    <p>Les informations que nous collectons peuvent être transférées dans les pays suivants, n’ayant pas de lois de protections des données équivalentes à celles en vigueur dans l’espace économique européen : les États-Unis d’Amérique, la Russie, le Japon, la Chine et l’Inde.</p>
    <p>Les informations personnelles que vous publiez sur notre site web ou que vous soumettez à la publication peuvent être disponibles, via internet, dans le monde entier. Nous ne pouvons empêcher l’utilisation, bonne ou mauvaise, de ces informations par des tiers.</p>
    <p>Vous acceptez expressément le transfert d’informations personnelles décrit dans cette Section 6.</p>

    <h2>7. Conservation de vos informations personnelles</h2>
    <p>Cette Section 7. détaille nos politiques de conservation des données et nos procédures, conçues pour nous aider à nous conformer à nos obligations légales concernant la conservation et la suppression d’informations personnelles.</p>
    <p>Les informations personnelles que nous traitons à quelque fin que ce soit ne sont pas conservées plus longtemps que nécessaire à cette fin ou à ces fins.</p>
    <p>Sans préjudice à l’article, nous supprimerons généralement les données personnelles de ces catégories :</p>
    <ul>
        <li>La durée de conservation des données : <?php echo $duree_concervation_donnees; ?></li>
    </ul>
    <p>Nous conserverons des documents (y compris des documents électroniques) contenant des données personnelles :</p>
    <ul>
        <li>Dans la mesure où nous sommes tenus de le faire par la loi ;</li>
        <li>Si nous pensons que les documents peuvent être pertinents pour toute procédure judiciaire en cours ou potentielle ;</li>
        <li>Pour établir, exercer ou défendre nos droits légaux (y compris fournir des informations à d’autres à des fins de prévention des fraudes et de réduction des risques de crédit).</li>
    </ul>
    <p>Si vous laissez un commentaire, le commentaire et ses métadonnées sont conservés indéfiniment. Cela permet de reconnaître et approuver automatiquement les commentaires suivants au lieu de les laisser dans la file de modération.</p>
    <p>Pour les utilisateurs et utilisatrices qui s’inscrivent sur notre site (si cela est possible), nous stockons également les données personnelles indiquées dans leur profil. Tous les utilisateurs et utilisatrices peuvent voir, modifier ou supprimer leurs informations personnelles à tout moment (à l’exception de leur nom d’utilisateur·ice). Les gestionnaires du site peuvent aussi voir et modifier ces informations.</p>

    <h2>8. Sécurité de vos informations personnelles</h2>
    <p>Nous prendrons des précautions techniques et organisationnelles raisonnables pour empêcher la perte, l’abus ou l’altération de vos informations personnelle.</p>
    <p>Nous stockerons toutes les informations personnelles que vous nous fournissez sur des serveurs sécurisés (protégés par mot de passe et pare-feu).</p>
    <p>Toutes les transactions financières électroniques effectuées par le biais de notre site web seront protégées par des technologies de cryptage.</p>
    <p>Vous reconnaissez que la transmission d’informations par internet est intrinsèquement non sécurisée, et que nous ne pouvons pas garantir la sécurité de vos données envoyées par internet.</p>
    <p>Vous êtes responsable de la confidentialité du mot de passe que vous utilisez pour accéder à notre site web ; nous ne vous demanderons pas votre mot de passe (sauf quand vous vous identifiez sur notre site web).</p>

    <h2>9. Amendements</h2>
    <p>Nous pouvons parfois mettre cette politique à jour en publiant une nouvelle version sur notre site web. Vous devez vérifier cette page régulièrement pour vous assurer de prendre connaissance de tout changement effectué à cette politique. Nous pouvons vous informer des changements effectués à cette politique par courrier électronique ou par le biais du service de messagerie privée de notre site web.</p>

    <h2>10. Vos droits</h2>
    <p>Vous pouvez nous demander de vous fournir toute information personnelle que nous détenons sur vous ; le transfert de telles informations sera soumis aux conditions suivantes :</p>
    <ul>
        <li>Nous pouvons retenir les informations personnelles que vous demandez dans la mesure autorisée par la loi.</li>
        <li>Vous pouvez nous demander à tout moment de ne pas traiter vos informations personnelles à des fins marketing.</li>
        <li>En pratique, vous exprimerez expressément et à l’avance votre accord pour que nous utilisions vos informations personnelles à des fins marketing ou nous vous fournirons une opportunité de refuser l’utilisation de vos informations personnelles à des fins marketing.</li>
    </ul>

    <p>Si vous avez un compte ou si vous avez laissé des commentaires sur le site, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Vous pouvez également demander la suppression des données personnelles vous concernant. Cela ne prend pas en compte les données stockées à des fins administratives, légales ou pour des raisons de sécurité.</p>

    <h2>11. Sites web tiers</h2>
    <p>Notre site web contient des liens hypertextes menant vers des sites web tiers et des informations les concernant. Nous n’avons aucun contrôle sur ces sites, et ne sommes pas responsables de leurs politiques de confidentialité ni de leurs pratiques.</p>
    <p>Les articles de ce site peuvent inclure des contenus intégrés (par exemple des vidéos, images, articles…). Le contenu intégré depuis d’autres sites se comporte de la même manière que si le visiteur se rendait sur cet autre site.</p>
    <p>Ces sites web pourraient collecter des données sur vous, utiliser des cookies, embarquer des outils de suivis tiers, suivre vos interactions avec ces contenus embarqués si vous disposez d’un compte connecté sur leur site web.</p>

    <h2>12. Mise à jour des informations</h2>
    <p>Merci de nous faire savoir si les informations personnelles que nous détenons à votre sujet doivent être corrigées ou mises à jour.</p>

    <h2>13. Cookies</h2>
    <p>Notre site web utilise des cookies. Un cookie est un fichier contenant un identifiant (une chaîne de lettres et de chiffres) envoyé par un serveur web vers un navigateur web et stocké par le navigateur. L’identifiant est alors renvoyé au serveur à chaque fois que le navigateur demande une page au serveur. Les cookies peuvent être « persistants » ou « de session » : un cookie persistant est stocké par le navigateur et reste valide jusqu’à sa date d’expiration, à moins d’être supprimé par l’utilisateur avant cette date d’expiration ; quant à un cookie de session, il expire à la fin de la session utilisateur, lors de la fermeture du navigateur. Les cookies ne contiennent en général aucune information permettant d’identifier personnellement un utilisateur, mais les informations personnelles que nous stockons à votre sujet peuvent être liées aux informations stockées dans les cookies et obtenues par les cookies.</p>
    <p>Nous n’utilisons que des cookies de session et des cookies persistants sur notre site web</p>

    <p>Les noms des cookies que nous utilisons sur notre site web et les objectifs dans lesquels nous les utilisons sont décrits ci-dessous :</p>
    <ul>
        <?php foreach($cookies_services as $cookies_service_key => $cookies_service): ?>
            <li><?php echo $cookies_service ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Nous pouvons utiliser les cookies pour :</p>
    <ul>
        <li>Reconnaître un ordinateur lorsqu’un utilisateur consulte le site web</li>
        <li>Suivre les utilisateurs lors de leur navigation sur le site web</li>
        <li>Activer l’utilisation d’un panier sur le site web</li>
        <li>Améliorer l’utilisation d’un site web</li>
        <li>Analyser l’utilisation du site web</li>
        <li>Administrer le site web</li>
        <li>Empêcher la fraude et améliorer la sécurité du site web</li>
        <li>Personnaliser le site web pour chaque utilisateur</li>
        <li>Envoyer des publicités ciblées pouvant intéresser certains utilisateurs </li>
    </ul>

    <p>La plupart des navigateurs vous permettent de refuser ou d’accepter les cookies :</p>
    <ul>
        <li>avec Internet Explorer (version 10), vous pouvez bloquer les cookies en utilisant les paramètres de remplacement de la gestion des cookies disponibles en cliquant sur «Outils», «Options internet», «Confidentialité» puis «Avancé»;</li>
        <li>avec Firefox (version 24), vous pouvez bloquer tous les cookies en cliquant sur «Outils», «Options», «Confidentialité» puis en sélectionnant «Utiliser des paramètres personnalisés pour l’historique» depuis le menu déroulant et en décochant «Accepter les cookies provenant des sites»;</li>
        <li>avec Chrome (version 29), vous pouvez bloquer tous les cookies en accédant au menu «Personnaliser et contrôler» puis en cliquant sur «Paramètres», «Montrer les paramètres avancés» et «Paramètres de contenu» puis en sélectionnant «Empêcher les sites de définir des données» dans l’en-tête «Cookies».</li>
    </ul>
    <p>Bloquer tous les cookies aura un impact négatif sur l’utilisation de nombreux sites web. Si vous bloquez les cookies, vous ne pourrez pas utiliser toutes les fonctionnalités de notre site web.</p>

    <p>Vous pouvez supprimer les cookies déjà stockés sur votre ordinateur :</p>
    <ul>
        <li>avec Internet Explorer (version 10), vous devez supprimer le fichier cookies manuellement (vous pourrez trouver des instructions pour le faire <a target="_blank" title="Support Microsoft - Comment faire pour supprimer des fichiers cookie dans Internet Explorer" href="https://support.microsoft.com/fr-fr/topic/comment-faire-pour-supprimer-des-fichiers-cookie-dans-internet-explorer-bca9446f-d873-78de-77ba-d42645fa52fc">ici</a> );</li>
        <li>avec Firefox (version 24), vous pouvez supprimer les cookies en cliquant sur «Outils», «Options», et «Confidentialité», puis en sélectionnant «Utiliser des paramètres personnalisés pour l’historique» et en cliquant sur «Montrer les cookies», puis sur «Supprimer tous les cookies»;</li>
        <li>avec Chrome (version 29), vous pouvez supprimer tous les cookies en accédant au menu «Personnaliser et contrôler» puis en cliquant sur «Paramètres», « Montrer les paramètres avancés » et «Supprimer les données de navigation» puis «Supprimer les cookies et les données des modules d’autres sites» avant de cliquer sur «Supprimer les données de navigation».</li>
    </ul>
    <p>Supprimer les cookies aura un impact négatif sur l’utilisation de nombreux sites web.</p>

    <p>Si vous déposez un commentaire sur notre site, il vous sera proposé d’enregistrer votre nom, adresse de messagerie et site web dans des cookies. C’est uniquement pour votre confort afin de ne pas avoir à saisir ces informations si vous déposez un autre commentaire plus tard. Ces cookies expirent au bout d’un an.</p>
    <p>Si vous vous rendez sur la page de connexion, un cookie temporaire sera créé afin de déterminer si votre navigateur accepte les cookies. Il ne contient pas de données personnelles et sera supprimé automatiquement à la fermeture de votre navigateur.</p>
    <p>Lorsque vous vous connecterez, nous mettrons en place un certain nombre de cookies pour enregistrer vos informations de connexion et vos préférences d’écran. La durée de vie d’un cookie de connexion est de deux jours, celle d’un cookie d’option d’écran est d’un an. Si vous cochez « Se souvenir de moi », votre cookie de connexion sera conservé pendant deux semaines. Si vous vous déconnectez de votre compte, le cookie de connexion sera effacé.</p>
    <p>En modifiant ou en publiant une publication, un cookie supplémentaire sera enregistré dans votre navigateur. Ce cookie ne comprend aucune donnée personnelle. Il indique simplement l’ID de la publication que vous venez de modifier. Il expire au bout d’un jour.</p>
</div>
