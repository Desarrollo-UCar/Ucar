<?php

use Illuminate\Database\Seeder;

class nacionalidades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

    $datos=[
'NAMIBIANA',
'ANGOLESA',
'ARGELIANA',
'DE BENNIN',
'BOTSWANESA',
'BURUNDESA',
'DE CABO VERDE',
'COMORENSE',
'CONGOLESA',
'MARFILEÑA',
'CHADIANA',
'DE DJIBOUTI',
'EGIPCIA',
'ETIOPE',
'GABONESA',
'GAMBIANA',
'GHANATA',
'GUINEA',
'GUINEA ECUATORIANA',
'LIBIA',
'KENIANA',
'LESOTHENSE',
'LIBERIANA',
'MALAWIANA',
'MALIENSE',
'MARROQUI',
'MAURICIANA',
'MAURITANA',
'MOZAMBIQUEÑA',
'NIGERINA',
'NIGERIANA',
'CENTRO AFRICANA',
'CAMERUNESA',
'TANZANIANA',
'RWANDESA',
'DEL SAHARA',
'DE SANTO TOME',
'SENEGALESA',
'DE SEYCHELLES',
'SIERRA LEONESA',
'SOMALI',
'SUDAFRICANA',
'SUDANESA',
'SWAZI',
'TOGOLESA',
'TUNECINA',
'UGANDESA',
'ZAIRANA',
'ZAMBIANA',
'DE ZIMBAWI',
'ARGENTINA',
'BAHAMEÑA',
'DE BARBADOS',
'BELICEÑA',
'BOLIVIANA',
'BRASILEÑA',
'CANADIENSE',
'COLOMBIANA',
'COSTARRICENSE',
'CUBANA',
'CHILENA',
'DOMINICA',
'SALVADOREÑA',
'ESTADOUNIDENSE',
'GRANADINA',
'GUATEMALTECA',
'BRITANICA',
'GUYANESA',
'HAITIANA',
'HONDUREÑA',
'JAMAIQUINA',
'MEXICANA',
'NICARAGUENSE',
'PANAMEÑA',
'PARAGUAYA',
'PERUANA',
'PUERTORRIQUEÑA',
'DOMINICANA',
'SANTA LUCIENSE',
'SURINAMENSE',
'TRINITARIA',
'URUGUAYA',
'VENEZOLANA',
'AMERICANA',
'AFGANA',
'DE BAHREIN',
'BHUTANESA',
'BIRMANA',
'NORCOREANA',
'SUDCOREANA',
'CHINA',
'CHIPRIOTA',
'ARABE',
'FILIPINA',
'HINDU',
'INDONESA',
'IRAQUI',
'IRANI',
'ISRAELI',
'JAPONESA',
'JORDANA',
'CAMBOYANA',
'KUWAITI',
'LIBANESA',
'MALASIA',
'MALDIVA',
'MONGOLESA',
'NEPALESA',
'OMANESA',
'PAKISTANI',
'DEL QATAR',
'SIRIA',
'LAOSIANA',
'SINGAPORENSE',
'TAILANDESA',
'TAIWANESA',
'TURCA',
'NORVIETNAMITA',
'YEMENI',
'ALBANESA',
'ALEMANA',
'ANDORRANA',
'AUSTRIACA',
'BELGA',
'BULGARA',
'CHECOSLOVACA',
'DANESA',
'VATICANA',
'ESPAÑOLA',
'FINLANDESA',
'FRANCESA',
'GRIEGA',
'HUNGARA',
'IRLANDESA',
'ISLANDESA',
'ITALIANA',
'LIECHTENSTENSE',
'LUXEMBURGUESA',
'MALTESA',
'MONEGASCA',
'NORUEGA',
'HOLANDESA',
'PORTUGUESA',
'BRITANICA',
'SOVIETICA BIELORRUSA',
'SOVIETICA UCRANIANA',
'RUMANA',
'SAN MARINENSE',
'SUECA',
'SUIZA',
'YUGOSLAVA',
'AUSTRALIANA',
'FIJIANA',
'SALOMONESA',
'NAURUANA',
'PAPUENSE',
'SAMOANA',
'ESLOVACA',
'BURKINA FASO',
'ESTONIA',
'MICRONECIA',
'REINO UNIDO(DEPEN. TET. BRIT.)',
'REINO UNIDO(BRIT. DEL EXT.)',
'REINO UNIDO(C. BRIT. DEL EXT.)',
'REINO UNIDO',
'KIRGUISTAN',
'LITUANIA',
'MOLDOVIA, REPUBLICA DE',
'MACEDONIA',
'ESLOVENIA',
'ESLOVAQUIA'

        ];
        for($i=0;$i<count($datos);$i++){
        DB::table('nacionalidades')-> insert([
            'nombre' => $datos[$i],
            'created_at'=>$date,
            'updated_at'=>$date
        ]);
        }
    }
}
