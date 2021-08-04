<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hjqs_Mentions_Legales
 * @subpackage Hjqs_Mentions_Legales/admin
 * @author     Hugo JACQUES <contact@hugojqs.fr>
 */
class Hjqs_Mentions_Legales_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $options
	 */
	private $options;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( string $plugin_name, string $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Create a page on admin dashboard
	 *
	 * @since    1.0.0
	 */
	public function add_settings_page() {
		add_options_page(
			__( 'Mentions Légales', $this->plugin_name ),
			__( 'Mentions Légales', $this->plugin_name ),
			'manage_options',
			'hjqs-mentions-legales',
			[ $this, 'render_mentions_legales_page' ]
		);
	}

	/**
	 * Render of Setting page
	 *
	 * @since    1.0.0
	 */
	public function render_mentions_legales_page() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/hjqs-mentions-legales-admin-display.php';
	}

	/**
	 * Register settings plugin
	 *
	 * @since    1.0.0
	 */
	public function register_settings_mentions_legales() {
		$this->options = get_option( 'hjqs_mentions_legales_options' );
		$options       = [
			'mentions-legales'             => [
				'label'       => 'Mentions légales',
				'description' => '<p>Configuration des <strong>mentions légales</strong>. Le shortcode <code>[hjqs_ml]</code> est à ajouter dans votre page pour afficher les mentions légales.</p><br /><p>Le générateur a le caractère d’<u>information juridique</u>, et non d’acte juridique. Nous ne pourrons être tenu responsable, de texte manquant dans vos mentions légales.</p>',
				'fields'      => [
					'entreprise_separator'  => [
						'label' => "<h3>Informations de l'entreprise</h3>",
						'type'  => 'separator',
					],
					'forme_juridique'       => [
						'label'         => "Forme juridique de l'entreprise",
						'helper'        => "Statut juridique de l'entreprise propriétaire du site",
						'type'          => 'choices',
						'choices'       => [
							'Entreprise Individuelle (EI)'                              => 'Entreprise Individuelle (EI)',
							'Entreprise Individuelle à Responsabilité Limitée (EIRL)'   => 'Entreprise Individuelle à Responsabilité Limitée (EIRL)',
							'Entreprise Unipersonnelle à Responsabilité Limitée (EURL)' => 'Entreprise Unipersonnelle à Responsabilité Limitée (EURL)',
							'Société Civile Immobilière (SCI)'                          => 'Société Civile Immobilière (SCI)',
							'Société Civile Professionnelle (SCP)'                      => 'Société Civile Professionnelle (SCP)',
							'Société Civile de Moyens (SCM)'                            => 'Société Civile de Moyens (SCM)',
							'Société A Responsabilité Limitée (SARL)'                   => 'Société A Responsabilité Limitée (SARL)',
							'Société par Actions Simplifiée (SAS)'                      => 'Société par Actions Simplifiée (SAS)',
							'Société par Actions Simplifiée Unipersonnelle (SASU)'      => 'Société par Actions Simplifiée Unipersonnelle (SASU)',
							'other'                                                     => 'Autre'
						],
						'choices_input' => [
							'type'   => 'text',
							'helper' => ""
						]
					],
					'proprietaire'          => [
						'label'  => 'Propriétaire du site',
						'helper' => 'Nom et prénom pour une entreprise, raison sociale pour une société.',
						'type'   => 'string',
					],
					'siret'                 => [
						'label'  => 'Numéro SIRET',
						'helper' => "Numéro de SIRET de l'entreprise",
						'type'   => 'string',
					],
					'rcs'                   => [
						'label'  => "Registre des Commerces et des Sociétés (RCS)",
						'helper' => "Numéro d'immatriculation au Registre des Commerces et des Sociétés (RCS)",
						'type'   => 'string',
					],
					'adresse'               => [
						'label'  => "Adresse postale du propriétaire",
						'helper' => "Adresse du propriétaire pour une entreprise, adresse du siège social pour une socété.",
						'type'   => 'string',
					],
					'responsable_separator' => [
						'label' => "<h3>Responsable du site internet</h3>",
						'type'  => 'separator',
					],
					'responsable'           => [
						'label'  => "Nom du responsable de publication",
						'helper' => "Personne qui gère le contenu du site",
						'type'   => 'string',
					],
					'responsable_contact'   => [
						'label'  => "Email ou téléphone du responsable de publication",
						'helper' => "Moyen de contacter le responsable de publication du site internet",
						'type'   => 'string',
					],
					'createur'              => [
						'label'  => "Nom du créateur du site",
						'helper' => "Nom du créateur du site (Webmaster)",
						'type'   => 'string',
					],
					'createur_site'         => [
						'label'  => "Site internet du créateur du site",
						'helper' => "URL du Site Internet",
						'type'   => 'string',
					],
					'createur_contact'      => [
						'label'  => "Email ou téléphone du créateur du site",
						'helper' => "Personne en charge des modifications techniques",
						'type'   => 'string',
					],
					'hebergeur'             => [
						'label'         => "Hébergeur du site",
						'helper'        => "Nom de l'hébergeur du site internet",
						'type'          => 'choices',
						'choices'       => [
							'OVH (2 Rue Kellermann, 59100 Roubaix)'                             => 'OVH (2 Rue Kellermann, 59100 Roubaix)',
							'Gandi (63-65 Boulevard Masséna, 75013 Paris)'                      => 'Gandi (63-65 Boulevard Masséna, 75013 Paris)',
							'Ionos - 1&1 (7 Place de la Gare, 57200 Sarreguemines)'             => 'Ionos - 1&1 (7 Place de la Gare, 57200 Sarreguemines)',
							'o2switch (222 Boulevard Gustave Flaubert, 63000 Clermont-Ferrand)' => 'o2switch (222 Boulevard Gustave Flaubert, 63000 Clermont-Ferrand)',
							'other'                                                             => 'Autres'
						],
						'choices_input' => [
							'type'   => 'text',
							'helper' => "Nom de l'entreprise, Adresse postale, SIRET"
						]
					],
				]
			],
			'condition-general-ventes'     => [
				'label'       => 'Conditions Générales de Vente',
				'description' => '<p>Configuration des <strong>conditions générales de vente</strong>. Le shortcode <code>[hjqs_cgv]</code> est à ajouter dans votre page pour les afficher.</p><br /><p>Le générateur a le caractère d’<u>information juridique</u>, et non d’acte juridique. Nous ne pourrons être tenu responsable, de texte manquant dans vos CGV.</p>',
				'fields'      => [
					'entreprise_separator'                  => [
						'label'  => "<h3>Informations de l'entreprise</h3>",
						'helper' => 'Helper',
						'type'   => 'separator',
					],
					'cgv_forme_juridique'                   => [
						'label'         => "Forme juridique de l'entreprise",
						'helper'        => "Statut juridique de l'entreprise propriétaire du site",
						'type'          => 'choices',
						'choices'       => [
							'Entreprise Individuelle (EI)'                              => 'Entreprise Individuelle (EI)',
							'Entreprise Individuelle à Responsabilité Limitée (EIRL)'   => 'Entreprise Individuelle à Responsabilité Limitée (EIRL)',
							'Entreprise Unipersonnelle à Responsabilité Limitée (EURL)' => 'Entreprise Unipersonnelle à Responsabilité Limitée (EURL)',
							'Société Civile Immobilière (SCI)'                          => 'Société Civile Immobilière (SCI)',
							'Société Civile Professionnelle (SCP)'                      => 'Société Civile Professionnelle (SCP)',
							'Société Civile de Moyens (SCM)'                            => 'Société Civile de Moyens (SCM)',
							'Société A Responsabilité Limitée (SARL)'                   => 'Société A Responsabilité Limitée (SARL)',
							'Société par Actions Simplifiée (SAS)'                      => 'Société par Actions Simplifiée (SAS)',
							'Société par Actions Simplifiée Unipersonnelle (SASU)'      => 'Société par Actions Simplifiée Unipersonnelle (SASU)',
							'other'                                                     => 'Autre'
						],
						'choices_input' => [
							'type'   => 'text',
							'helper' => ""
						]
					],
					'cgv_proprietaire'                      => [
						'label'  => 'Propriétaire du site',
						'helper' => 'Nom et prénom pour une entreprise, raison sociale pour une société.',
						'type'   => 'string',
					],
					'cgv_adresse'                           => [
						'label'  => "Adresse postale du propriétaire",
						'helper' => "Adresse du propriétaire pour une entreprise, adresse du siège social pour une socété.",
						'type'   => 'string',
					],
					'cgv_siret'                             => [
						'label'  => 'Numéro SIRET',
						'helper' => "Numéro de SIRET de l'entreprise",
						'type'   => 'string',
					],
					'cgv_capital_social'                    => [
						'label'  => "Capital Social de l'entreprise",
						'helper' => "Capital social de l'entreprise (avec la devise)",
						'type'   => 'string',
					],
					'cgv_rcs'                               => [
						'label'  => "Registre des Commerces et des Sociétés (RCS)",
						'helper' => "Numéro d'immatriculation au Registre des Commerces et des Sociétés (RCS)",
						'type'   => 'string',
					],
					'responsable_separator'                 => [
						'label' => "<h3>Responsable de la boutique</h3>",
						'type'  => 'separator',
					],
					'cgv_responsable'                       => [
						'label'  => "Nom du responsable",
						'helper' => "Personne qui gère le contenu et les produits du site",
						'type'   => 'string',
					],
					'cgv_responsable_contact'               => [
						'label'  => "Email ou téléphone du responsable de la boutique",
						'helper' => "Moyen de contacter le responsable de la boutique du site internet",
						'type'   => 'string',
					],
					'cgv_moyens_de_paiement'                => [
						'label'   => "Moyen de paiement",
						'helper'  => "Prestataires de la gestion des paiements",
						'type'    => 'multi-select',
						'choices' => [
							'Stripe'              => 'Stripe',
							'PayPal'              => 'PayPal',
							'Monetico (CIC / CM)' => 'Monetico (CIC / CM)',
							'Mercanet (BNP)'      => 'Mercanet (BNP)',
							'PayPlug'             => 'PayPlug',
							'Espèces'             => 'Espèces',
							'Chèques'             => 'Chèques',
							'Google Pay'          => 'Google Pay',
							'Apple Pay'           => 'Apple Pay',
						]
					],
					'cgv_duree_de_concervation_des_donnees' => [
						'label'  => 'Durée de conservation des données',
						'helper' => "Durée de conservation des données personnelles de l'utilisateur (email, nom, adresse, etc.)",
						'type'   => 'string'
					],
					'retour_separator'                      => [
						'label' => "<h3>Conditions de retour</h3>",
						'type'  => 'separator',
					],
					'cgv_produit_sans_retour'               => [
						'label'  => 'Type de produits sans retour possible',
						'type'   => 'string',
						'helper' => " Décrire les biens non sujets à ces dispositions"
					],
					'cgv_conditions_retour'                 => [
						'label'         => "Procédure de remboursement",
						'helper'        => 'Procédure de remboursement et de retour produit',
						'type'          => 'choices',
						'choices'       => [
							'other' => 'Autres'
						],
						'choices_input' => [
							'type'   => 'text',
							'helper' => "Décrire la procédure de remboursement, et comment le produit doit être retourné, et le remboursement des frais d'expédition le cas échéant)."
						]
					],
					'cgv_adresse_retour'                    => [
						'label'  => "Adresse postale de retour",
						'helper' => "Adresse postale utilisée par les clients pour faire des retours.",
						'type'   => 'string',
					],
					'cgv_indisponibilite_produit_temps'     => [
						'label'  => "Durée d'annulation",
						'helper' => "Durée d'annulation ou de remboursement en cas d'indisponibilité d'un produit (en jours ouvrables)",
						'type'   => 'int'
					]
				]
			],
			'politique-de-confidentialite' => [
				'label'       => 'Politique de Confidentialité',
				'description' => '<p>Configuration de la <strong>politique de confidentialité</strong>. Le shortcode <code>[hjqs_pdc]</code> est à ajouter dans votre page pour les afficher.</p><br /><p>Le générateur a le caractère d’<u>information juridique</u>, et non d’acte juridique. Nous ne pourrons être tenu responsable, de texte manquant dans votre politique de confidentialité.</p>',
				'fields'      => [
					'pdc'                                   => [
						'label'  => "<h3>Actions de l'utilisateur</h3>",
						'helper' => 'Helper',
						'type'   => 'separator',
					],
					'pdc_user_can_subscribe'                => [
						'label'   => "L'utilisateur peut s'inscrire sur le site web ?",
						'helper'  => "L'utilisateur dispose d'un compte. Des informations sont collectées (email, nom, prénom, etc.)",
						'type'    => 'choices',
						'choices' => [
							'Oui' => 'Oui',
							'Non' => 'Non',
						],
					],
					'pdc_user_can_submit_form'              => [
						'label'   => "L'utilisateur peut completer un formulaire",
						'helper'  => "Le site internet dispose d'un formulaire (contact, newsletter, etc.). Si oui, les informations du formulaire sont collectées",
						'type'    => 'choices',
						'choices' => [
							'Oui' => 'Oui',
							'Non' => 'Non',
						],
					],
					'pdc_user_can_purcharge'                => [
						'label'   => "L'utilisateur peut passer une commande ?",
						'helper'  => "Des informations liées à la commande sont collectées",
						'type'    => 'choices',
						'choices' => [
							'Oui' => 'Oui',
							'Non' => 'Non',
						],
					],
					'pdc_user_can_publish'                  => [
						'label'   => "L'utilisateur peut publier du contenu ?",
						'helper'  => "Des informations liées à la publication sont collectées (titre, auteur, date, etc.)",
						'type'    => 'choices',
						'choices' => [
							'Oui' => 'Oui',
							'Non' => 'Non',
						],
					],
					'pdc_duree'                             => [
						'label' => '<h3>Durée de concervation</h3>',
						'type'  => 'separator',
					],
					'pdc_duree_de_concervation_des_donnees' => [
						'label'  => 'Durée de conservation des données',
						'helper' => "Durée de conservation des données personnelles de l'utilisateur (email, nom, adresse, etc.)",
						'type'   => 'string'
					],
					'pdc_outils'                            => [
						'label' => '<h3>Outils utilisés</h3>',
						'type'  => 'separator'
					],
					'pdc_outils_stats'                      => [
						'label'   => "Liste des outils utilisés",
						'helper'  => "",
						'type'    => 'multi-select',
						'choices' => [
							'Google Analytics'  => 'Google Analytics',
							'Google Adwords'    => 'Google Adwords',
							'Pixel Facebook'    => 'Pixel Facebook',
							'LinkedIn Tracking' => 'LinkedIn Tracking',
							'Hotjar'            => 'Hotjar',
							'Crazy Egg'         => 'Crazy Egg',
							'Stat Counter'      => 'Stat Counter',
							'Clicky'            => 'Clicky',
							'Kiss Metrics'      => 'Kiss Metrics',
							'Woopra'            => 'Woopra',
							'Adobe Analytics'   => 'Adobe Analytics',
						]
					],

				],
			],
		];

		register_setting( 'hjqs_mentions_legales_options_group', 'hjqs_mentions_legales_options', [
			$this,
			'sanitize'
		] );

		foreach ( $options as $options_group_key => $options_group ) {
			$group_id = $this->plugin_name . "_" . $options_group_key;
			add_settings_section(
				$group_id,
				$options_group['label'],
				function () use ( $options_group ) {
					$this->render_settings_section_mentions_legales( $options_group['description'] );
				},
				$this->plugin_name
			);
			foreach ( $options_group['fields'] as $option_key => $field ) {
				add_settings_field(
					$option_key,
					$field['label'],
					function () use ( $field, $option_key ) {
						$this->render_settings_field_mentions_legales( $field, $option_key );
					},
					$this->plugin_name,
					$group_id
				);
			}
		}
	}

	/**
	 * Display Description of Section
	 *
	 * @param string $description
	 *
	 * @since    1.0.0
	 */
	public function render_settings_section_mentions_legales( string $description ) {
		echo "<span class='tabs-description'>$description</span>";
	}

	/**
	 * Display Field
	 *
	 * @param array $field_options
	 *
	 * @param $key
	 *
	 * @since    1.0.0
	 */
	public function render_settings_field_mentions_legales( array $field_options, $key ) {
		$options = get_option( "hjqs_mentions_legales_options" );
		//delete_option( 'hjqs_mentions_legales_options' );
		?>

        <div class="hjqs_ml-field hjqs_ml-field-<?php echo $key ?>">
			<?php
			if ( $field_options['type'] === 'string' ) {
				?>
                <input type="text" id="<?php echo $key ?>" name="hjqs_mentions_legales_options[<?php echo $key ?>]"
                       value="<?php echo $options[ $key ] ?>"/>
                <label for="<?php echo $key ?>"><?php echo $field_options['helper'] ?></label>
				<?php
			} else if ( $field_options['type'] === 'int' ) {
				?>
                <input type="number" id="<?php echo $key ?>" name="hjqs_mentions_legales_options[<?php echo $key ?>]"
                       value="<?php echo $options[ $key ] ?>"/>
                <label for="<?php echo $key ?>"><?php echo $field_options['helper'] ?></label>
				<?php
			} else if ( $field_options['type'] === 'choices' ) {
				?>
                <select name="hjqs_mentions_legales_options[<?php echo $key ?>]">
					<?php foreach ( $field_options['choices'] as $item_key => $item ) : ?>
                        <option <?php selected( $options[ $key ], $item_key ); ?>
                                value="<?php echo $item_key ?>"><?php echo $item ?></option>
					<?php endforeach; ?>
                </select>
                <label for="hjqs_mentions_legales_options[<?php echo $key ?>]"><?php echo $field_options['helper'] ?></label>
                <?php if ( isset( $field_options['choices_input'] ) ) : ?>
                    <div class="hjqs_ml-choices-other">
                        <input type="<?php echo $field_options['choices_input']['type'] ?>" id="<?php echo $key ?>"
                               name="hjqs_mentions_legales_options[<?php echo $key ?>]"
                               value="<?php echo $options[ $key ] ?>"/>
                        <label for="hjqs_mentions_legales_options[<?php echo $key ?>]"><?php echo $field_options['choices_input']['helper'] ?></label>
                    </div>

				<?php endif; ?>
				<?php
			} else if ( $field_options['type'] === 'radio' ) {
				?>
				<?php foreach ( $field_options['choices'] as $item_key => $item ) : ?>
                    <div>
                        <input type="radio" id="<?php echo $item_key ?>" name="hjqs_mentions_legales_options[<?php echo $key ?>]"
                               value="<?php echo $item_key ?: 'OVH' ?>" <?php checked( $options[ $key ], $item_key, true ) ?> />
                        <label for="<?php echo $item_key ?>"><?php echo $item ?></label>
                    </div>
				<?php endforeach; ?>

                <label for="<?php echo $key ?>"><?php echo $field_options['helper'] ?></label>
				<?php
			} else if ( $field_options['type'] === 'multi-select' ) {
				?>
				<?php foreach ( $field_options['choices'] as $item_key => $item ) : ?>
                    <div style="display: inline-block; width: auto; margin-top: 5px">
                    <input <?php isset( $options[ $key ][ $item_key ] ) ? checked( $options[ $key ][ $item_key ], $item_key ) : null; ?>
                            type="checkbox" id="<?php echo $item_key ?>"
                            name="hjqs_mentions_legales_options[<?php echo $key ?>][<?php echo $item_key ?>]"
                            value="<?php echo $item ?>"/>
                    <label style="margin-right: 15px" for="<?php echo $item_key ?>"><?php echo $item ?></label>
                    </div>
				<?php endforeach; ?>
                <label for="<?php echo $key ?>"><?php echo $field_options['helper'] ?></label>
				<?php
			} else if ( $field_options['type'] === 'separator' ) {
				return;
			} else {
				echo __( 'Error on this field', $this->plugin_name );
			}
			?>
        </div>
		<?php
	}

	public function sanitize( $input ) {
		if ( ! isset( $input['hebergeur'] ) ) {
			$input['hebergeur'] = '';
		}
		if ( ! isset( $input['cgv_moyens_de_paiement'] ) ) {
			$input['cgv_moyens_de_paiement'] = [];
		}

		return $input;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_register_style( 'jquery-ui', ( "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" ), false );
		//wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hjqs-mentions-legales-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hjqs-mentions-legales-admin.js', array( 'jquery' ), $this->version, false );

	}

}
