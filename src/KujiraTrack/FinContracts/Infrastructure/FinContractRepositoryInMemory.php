<?php

namespace Ocebot\KujiraTrack\FinContracts\Infrastructure;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContract;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractRepository;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContracts;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractTickerId;

class FinContractRepositoryInMemory implements FinContractRepository
{
    private array $finContracts = [];

    public function __construct()
    {
        $finContracts = [
            // *** axlUSDC pairs
            "KUJI_axlUSDC" => [
                "contract" => "kujira14hj2tavq8fpesdwxxcu44rty3hh90vhujrvcmstl4zr3txmfvw9sl4e867"
            ],
            "JUNO_axlUSDC" => [
                "contract" => "kujira1z7asfxkwv0t863rllul570eh5pf2zk07k3d86ag4vtghaue37l5s9epdvn"
            ],
            "EVMOS_axlUSDC" => [
                "contract" => "kujira182nff4ttmvshn6yjlqj5czapfcav9434l2qzz8aahf5pxnyd33tsz30aw6"
            ],
            "wETH_axlUSDC" => [
                "contract" => "kujira1suhgf5svhu4usrurvxzlgn54ksxmn8gljarjtxqnapv8kjnp4nrsqq4jjh",
                "decimals" => 12
            ],
            "axlUSDT_axlUSDC" => [
                "contract" => "kujira1xut80d09q0tgtch8p0z4k5f88d3uvt8cvtzm5h3tu3tsy4jk9xlscem692"
            ],
            "xAVAX_axlUSDC" => [
                "contract" => "kujira1qjxu65ucccpg8c5kac8ng6yxfqq85fluwd0p9nt74g2304qw8eyq930y7w",
                "decimals" => 12
            ],
            "STARS_axlUSDC" => [
                "contract" => "kujira1jkte0pytr85qg0whmgux3vmz9ehmh82w40h8gaqeg435fnkyfxqq5m32qy"
            ],
            "LOOP_axlUSDC" => [
                "contract" => "kujira10fqy0npt7djm8lg847v9rqlng88kqfdvl8tyt4ge204wf52sy68qwmj07l"
            ],
            "CMDX_axlUSDC" => [
                "contract" => "kujira16y344e8ryydmeu2g8yyfznq79j7jfnar4p59ngpvaazcj83jzsms6tju67"
            ],
            "ATOM_axlUSDC" => [
                "contract" => "kujira1xr3rq8yvd7qplsw5yx90ftsr2zdhg4e9z60h5duusgxpv72hud3sl8nek6"
            ],
            "OSMO_axlUSDC" => [
                "contract" => "kujira1aakfpghcanxtc45gpqlx8j3rq0zcpyf49qmhm9mdjrfx036h4z5sfmexun"
            ],
            "SCRT_axlUSDC" => [
                "contract" => "kujira1fkwjqyfdyktgu5f59jpwhvl23zh8aav7f98ml9quly62jx2sehysqa4unf"
            ],
            "LUNA_axlUSDC" => [
                "contract" => "kujira1yg8930mj8pk288lmkjex0qz85mj8wgtns5uzwyn2hs25pwdnw42skp0kur"
            ],
            "wBNB_axlUSDC" => [
                "contract" => "kujira1apkgj87fgfsq84swvkyfaemrq7t4deuh60887lek0hkgdjh5fj0qaz7fhx",
                "decimals" => 12
            ],
            "DOT_axlUSDC" => [
                "contract" => "kujira1w4t2qpwvhyhz0g2mwgqjzgsw63dcy5hkfch0tgr8xj9qjcsauq8q5x0zxz",
                "decimals" => 4
            ],
            "gPAxG_axlUSDC" => [
                "contract" => "kujira12p30cr4gstmp2yucwxtaq92turrzsxxar8upz3rhmfjxh6gdgk4s5vsyse",
                "decimals" => 12
            ],
            "MARS_axlUSDC" => [
                "contract" => "kujira149m52kn7nvsg5nftvv4fh85scsavpdfxp5nr7zasz97dum89dp5qevttd9"
            ],
            "wTAO_axlUSDC" => [
                "contract" => "kujira17qp8g5n5wwelrsnfdakrv0p550nzg72agpcz5t0ea6thlqd300hquxljcc",
                "decimals" => 12
            ],
            "MNTA_axlUSDC" => [
                "contract" => "kujira1ws9w7wl68prspv3rut3plv8249rm0ea0kk335swye3sl2slld4lqdmc0lv"
            ],
            "NTRN_axlUSDC" => [
                "contract" => "kujira1kt0jxlr5fkx3xepymxav5c3h8sjnmutp3za2e6r5k9pgsta34trq8emzqj"
            ],

            // *** USDC PAIRS
            "KUJI_USDC" => [
                "contract" => "kujira1pw96huy6z02uk8hdpruk6g8u700dp8yxjhp46c24rwkzay2lfd3quqdum5"
            ],
            "axlUSDC_USDC" => [
                "contract" => "kujira1zg4e37hz5hzlf8kmcaxjf85nyevk3qr2dp307lafdgst2928rghqed59ed"
            ],

            "MNTA_USDC" => [
                "contract" => "kujira16mnw6am32ecqacsgz2kf9gfy8sh4uqyv0246f3rxnjz4up9k462q34jck5"
            ],
            // "gUSDC_USDC"    =>  [
            //"contract" => "kujira1m7jfsvnsa7k2v6vaettc86tlvrzjpn96dr2pyfd7pcf0ze9gnccsv7eh6s"
            //],

            // *** USK PAIRS
            "ATOM_USK" => [
                "contract" => "kujira1yum4v0v5l92jkxn8xpn9mjg7wuldk784ctg424ue8gqvdp88qzlqr2qp2j"
            ],
            "KUJI_USK" => [
                "contract" => "kujira193dzcmy7lwuj4eda3zpwwt9ejal00xva0vawcvhgsyyp5cfh6jyq66wfrf"
            ],
            "axlUSDC_USK" => [
                "contract" => "kujira1rwx6w02alc4kaz7xpyg3rlxpjl4g63x5jq292mkxgg65zqpn5llq202vh5"
            ],
            // "AXL_USK"       =>  [
            //"contract" => "kujira1dtaqwlmzlk3jku5un6h6rfunttmwsqnfz7evvdf4pwr0wypsl68q49aaud"
            //],
            "CRO_USK" => [
                "contract" => "kujira10j648ftg2g8p5vhgsu5kzfh6d907vpkrn0a5l3qch479eqy2qssqm905c4"
            ],
            "LUNA_USK" => [
                "contract" => "kujira1zz74gvmq6ss3pg5vgahvx47ugpfzr80qu75l97lf2ggdgxq04ddqxkdzey"
            ],
            "wBNB_USK" => [
                "contract" => "kujira1a0fyanyqm496fpgneqawhlsug6uqfvqg2epnw39q0jdenw3zs8zqsjhdr0",
                "decimals" => 12
            ],
            "STRD_USK" => [
                "contract" => "kujira1cn922pcqrt4g2dr4va9vxk8h3w3jfxnxjqq2qp6zktjsehdzde6sz66um0"
            ],
            "LOCAL_USK" => [
                "contract" => "kujira1sse6a00arh9dalzsyrd3q825dsn2zmrag0u4qx8q0dyks4ftnxyqrj0xds"
            ],
            "wMATIC_USK" => [
                "contract" => "kujira1rrnacml8zeqq3ve2t98r5x88t4uahahdk66y9qpcrjp9qxhnuvysv59zx8",
                "decimals" => 12
            ],
            "wBTC_USK" => [
                "contract" => "kujira1ulyrqqtx9vqsk92805jk7xxwz77lszmm2f548juyced96tj4lg7qugewsf"
            ],
            "USDC_USK" => [
                "contract" => "kujira1zg4e37hz5hzlf8kmcaxjf85nyevk3qr2dp307lafdgst2928rghqed59ed"
            ],
            "WINK_USK" => [
                "contract" => "kujira1qxtd87qus6uzvqs4jv9r0j9ccd4yla42s6qag7y8fp7hhv68nzas6hqxgw"
            ],
            "NSTK_USK" => [
                "contract" => "kujira1ggtmfuktfcf6plhtdejyyqn5de5uge3tef0jv64ru68h2ctuvyqs3355mn"
            ],
            "FUZN_USK" => [
                "contract" => "kujira1w6gpsfn55ufh3g3pf6qjrdhfj6rp09zqmruvgvzupkl39mtlpcdqw2ys7e"
            ],
            "MNTA_USK" => [
                "contract" => "kujira1mf4v3x3pkuthha5a4r9jd0slgulcxkucy4weuqsvx2n030twduzqewuznf"
            ],
            "NTRN_USK" => [
                "contract" => "kujira18vzzgwgc4c7mehenjllxvsnydg3gch0a63pedxl4ldrr6gexvyfqk7kupd"
            ],
            "SCRT_USK" => [
                "contract" => "kujira1rpxf55u22q2tly9y8rgdrjgx9p52sus7jugaevj3hdt0z7sgvkcsyrhrv0"
            ],
            "SHD_USK" => [
                "contract" => "kujira1cduudfszcm9slm8qxlaqvnpzg2u0hkus94fe3pwt9x446dtw6eeql8ualz"
            ],
            "STARS_USK" => [
                "contract" => "kujira1nm3yktzcgpnvwu6qpzqgl2ktyvlgsstc7ev849dd3ulaygw75mqqxvtnck"
            ],
            "wETH_USK" => [
                "contract" => "kujira17w9r23r8v8r7z5lphwj99296fhlye9ej5nq3hlqw554u63m88avspdl9tc",
                "decimals" => 12
            ],
            "FURY_USK" => [
                "contract" => "kujira1v8lkqws3gd6npr0rdk9ch54amh9guas86r4u62jq27hee88lryfsxwrvlk"
            ],
            "ampLUNA_USK" => [
                "contract" => "kujira1uvqk5vj9vn4gjemrp0myz4ku49aaemulgaqw7pfe0nuvfwp3gukq64r3ws"
            ],
            "AQUA_USK" => [
                "contract" => "kujira13l8gwanf37938wgfv5yktmfzxjwaj4ysn4gl96vj78xcqqxlcrgssfl797"
            ],
            "DOT_USK" => [
                "contract" => "kujira1jlzw6xal0n2c580g3wxs09tjhlzdht9y8dgszq3tupf8fhl7xjus7ep7ap",
                "decimals" => 4
            ],
            "CMDX_USK" => [
                "contract" => "kujira1h7eenquygffwsmc8csrlx88zcddwx0aqspq3x2dsl20lwk4r9n2q9t86ht"
            ],
            "wAVAX_USK" => [
                "contract" => "kujira1fphguznhazgqdlr9mpfh6nmn3vjjr73ksz3ukznv6q7s9ndfq2cs8vhapj",
                "decimals" => 12
            ],
            "CMST_USK" => [
                "contract" => "kujira1qw5hdcmcf4aq5xmnu6znscurvkgvhxfsyvhz3jvxhasxjwtk3l7sccwcs8"
            ],
            "wFTM_USK" => [
                "contract" => "kujira1ky9kv2m4dnykm90d0lj5089k4efttgfpx34zyvkklxnew48c522sggqjsg"
            ],
            "gPAxG_USK" => [
                "contract" => "kujira1rtpn4nxkx7u5y4uf5lp4ywrhmnms07p8p8wc3pmw53hfv0lhyxdqlfhgrt",
                "decimals" => 12
            ],
            "DAI_USK" => [
                "contract" => "kujira18lm235jzuh4t7hh5z8lqyz08dmz67magj8z0fc4a0vn6c0hzk0es3r4glx",
                "decimals" => 12
            ],
            "wTAO_USK" => [
                "contract" => "kujira1538ukswznmuek3hfv7mcxem9hjqz8sa4ypl2ul0zncu3tdgfvwmq8pxkwp",
                "decimals" => 12
            ],
            "MARS_USK" => [
                "contract" => "kujira1v8kh6mqxq7awcvl936xeyzv8fnmdkd3yxggvkyek5d0ecut4a6zs0larj2"
            ],
            "CNTO_USK" => [
                "contract" => "kujira1642dp8q7gzm5g5csdz2k676rc5zqfka4hfnas9ffydffp0saspts0e9zgp"
            ],
            "GRAV_USK" => [
                "contract" => "kujira18638dsuf7p3a2e23seqz8zegqrcpsdr5nw6j2a50qg6r3q8vn3qqrg9lzp"
            ],
            "INJ_USK" => [
                "contract" => "kujira1ddeadmhum3umygv84frhc87gl2grzjmx9x8fuhjts7zqwuc39xuq53w3d8"
            ],
            "WHALE_USK" => [
                "contract" => "kujira1x38mke7q0qut5lku4zrx7wgjrsj9jn3tffadegzzcsy9s5w5mdmqzzl0sn"
            ],
            "ACRE_USK" => [
                "contract" => "kujira1zumrlzj7ffq0murckuzykgsvcn3xzyvn3e85fxjsymwyhezmkycqtq87zj"
            ],
            "xASTRO_USK" => [
                "contract" => "kujira1qwtjeaf0y6hn094gn3xprw7wknkl4egpkr7dqu3cljkev5ex4xfqf2h8uc"
            ],
            "SWTH_USK" => [
                "contract" => "kujira1aqnmhyu37ynf8pm0fedtykzf3clk25ecc0p23cce2d5dc59eteeqgrg6tv"
            ],
            "PLANQ_USK" => [
                "contract" => "kujira1q7p9wldxxvnqda4hx8w6caplqj33tfxne5efjamsp6ruhuk3knwqwjuhrn"
            ],
            "DVPN_USK" => [
                "contract" => "kujira1ullqzk95uh0derdqpp8e5f4ukdun00xdal486zmjeeqsfhefgd0qh0qndl"
            ],
            "ROAR_USK" => [
                "contract" => "kujira1vllmvr0ylegpgg34y727kmys4yy3kjjnwj8xt3j22mdc5u4z7egs5d0sg8"
            ],
            "AKT_USK" => [
                "contract" => "kujira1ppr63x265m0sgqdhl2k23t8hmfcgrar85rxgq45uvctksr8w8hzsqwwdcq"
            ],
            "ARB_USK" => [
                "contract" => "kujira1zf94p6srpmlk0d5p9pwpqqwztynd22mndqljqvral604k8jfcw4sw2y7kp"
            ],
            "CRE_USK" => [
                "contract" => "kujira1nu8kef49y0pdrkphtkt857tgtt0pe8nr8ms0pnp6lylrav9jq2asmjljhe"
            ],
            "FLIX_USK" => [
                "contract" => "kujira1uau4ctnpfze4qqljqgup3watfg9yvmkgr7gevzgv27g30yx56fvsr6dkqx"
            ],
            "LUNC_USK" => [
                "contract" => "kujira10lzmqlvey89gwd4jz8aq3s4xdllk2k56yj45cex9s86v8g7nkpmq24djj4"
            ],
            "MNTL_USK" => [
                "contract" => "kujira1vpvt27kwaasyfxyd9lkfu3xlm3axmayg40z8reas7l7nk659kcqsgywtdv"
            ],
            "stOSMO_USK" => [
                "contract" => "kujira1tnnvtvere0pwz0uupy4crl3dv6yszte9nqms4fwmfhj3e2yl477sa0frks"
            ],
            "PLQ_USK" => [
                "contract" => "kujira1q7p9wldxxvnqda4hx8w6caplqj33tfxne5efjamsp6ruhuk3knwqwjuhrn"
            ],
            "RAC_USK" => [
                "contract" => "kujira1kmw6fk5p7an27u8f3er08xrwvzlehczymgshkqxzfrxyrfleu2eqxykaln"
            ],
            "REGEN_USK" => [
                "contract" => "kujira1p2vmq7g8fghkeak0hz4qfgeskkd7zqp3vnj6m3sa0r6gp4dr37usmtgtej"
            ],
            "SOMM_USK" => [
                "contract" => "kujira1wckallump2k4284pt5wqg63a8prr205y532ym3850l82k75yzems5mfnkj"
            ],
            "LINK_USK" => [
                "contract" => "kujira12zjpumtfh88k6s2s8k4wks37ezr2c3zeha5xx6qpd65e5ehz50nq0afvrv",
                "decimals" => 12
            ],

            // *** MNTA PAIRS
            "stATOM_MNTA" => [
                "contract" => "kujira1l2x5c2fjjnw9uhrfhtme9snw3tzs4jt8cm0q2ysqssx6zskxatesjm7w7f",
                "nominative" => "MNTA_USDC"
            ],
            "wstETH_MNTA" => [
                "contract" => "kujira1hf44at7dqewrn3ssa392d9p8nh5mr538u59gqsukdza35663hlestqr29e",
                "nominative" => "MNTA_USDC"
            ],
            "wETH_MNTA" => [
                "contract" => "kujira13xyuyw93pv6t7c4h248tc8t6kgu874v5qasmjfzqjfjhfp6hawlse5u5tz",
                "nominative" => "MNTA_USDC"
            ],
            "STARS_MNTA" => [
                "contract" => "kujira1hsdzhyvuc2z3f8d3yae84uk62d69vk68vxgudkun7gccz6hvrvfq0vx6fd",
                "nominative" => "MNTA_USDC"
            ],
            "wBTC_MNTA" => [
                "contract" => "kujira1y50nul39ql5sf42p67nrsy9j0luly2mvaxmlkmx6888pnzw66k6qc0gku9",
                "nominative" => "MNTA_USDC"
            ],
            "OSMO_MNTA" => [
                "contract" => "kujira12zc52j25xac565t297rmd3huj8zh62usrecy66rzxnsf9mchaepqnwx3cg",
                "nominative" => "MNTA_USDC"
            ],
            "SOMM_MNTA" => [
                "contract" => "kujira1nx5lqc2j4w0ak5dxevj82lar5kunxwj5yamr39xqfazmkksx4f2sksf0hz",
                "nominative" => "MNTA_USDC"
            ],
            "yieldETH_MNTA" => [
                "contract" => "kujira1sr2hf68nc8a8f2e42tsjf3zmsgjkl4jmctszdzxes0whyk2tzn5sd3avg7",
                "nominative" => "MNTA_USDC"
            ],
            "STRD_MNTA" => [
                "contract" => "kujira1u2gj9a6p07hse07p66jqnq7xchneecxrq032vl4z2z97ft2r0zeqx4hadf",
                "nominative" => "MNTA_USDC"
            ],
            "SHD_MNTA" => [
                "contract" => "kujira14u8ynhj7d8h2379yqj5q2ma0xxpvfjlrpauhzxgnj40ejq953mlsugux8d",
                "nominative" => "MNTA_USDC"
            ],
            "INJ_MNTA" => [
                "contract" => "kujira17356flrg56cjs7ardg0c6jpufwyeafegss6l4asza4chrr0ne7aqfesynu",
                "nominative" => "MNTA_USDC"
            ],
            "AXL_MNTA" => [
                "contract" => "kujira17r5u5r9gl3p9lql7p4dhdcffnv2z0f4xxafvgl8wnhw8qeez4x6q9zflp7",
                "nominative" => "MNTA_USDC"
            ],
            "AKT_MNTA" => [
                "contract" => "kujira1krepsjxnpesa5u2amklew60r6zgtrmt9h2ljx8dnzljp0wxcstnqxfy0tk",
                "nominative" => "MNTA_USDC"
            ],
            "NTRN_MNTA" => [
                "contract" => "kujira1hcvm4thkc0mq55cjzttp0fmh6gu5hzrfm4trgwpkm38nmd63tu0qha647q",
                "nominative" => "MNTA_USDC"
            ],
            "WINK_MNTA" => [
                "contract" => "kujira19rmgf792tgl446fnyc4wjdj2t20jlt5t3wudxyuhfy2ccy67g0hsrt73d8",
                "nominative" => "MNTA_USDC"
            ],
            "WHALE_MNTA" => [
                "contract" => "kujira1865zmuchjd0g0xr2q5n6hm747s8xju5k8h6mympk4vmqefkuy3hqc66tcw",
                "nominative" => "MNTA_USDC"
            ],
            "UMEE_MNTA" => [
                "contract" => "kujira180qesrskvljsvvkhvlkrwvyvu5hx03jhx76lvwxveq86at4ttqxq259wz8",
                "nominative" => "MNTA_USDC"
            ],
            "TIA_MNTA" => [
                "contract" => "kujira1vwr998s2mmvqa0t2tlfayvv5uzsl7t4syxd7a94qdgstfy4720rsa3n9yp",
                "nominative" => "MNTA_USDC"
            ],
            "wTAO_MNTA" => [
                "contract" => "kujira1tgd479qm2cu30yr4568l23aaz0p2wcr979wx3z7wlsgcc5fj6rxshc2uwx",
                "nominative" => "MNTA_USDC"
            ],
            "whSOL_MNTA" => [
                "contract" => "kujira1tdad4e3c6qz6htdha4wg4ta6l86chnpyy22rfm60e6luj4wv2casjsrtj0",
                "nominative" => "MNTA_USDC"
            ],
            "SCRT_MNTA" => [
                "contract" => "kujira1y5k75yuygkr9wmpl3huy5spqktgq9w2ex3zndu0zw6l2n0mzf4asz7hdat",
                "nominative" => "MNTA_USDC"
            ],
            "NTSK_MNTA" => [
                "contract" => "kujira1ff9pnz3ekflj6vkyk2taf4tvvjh4a8fp8hetw3dc59xu8ywl8tmstcf9de",
                "nominative" => "MNTA_USDC"
            ],
            "ampMNTA_MNTA" => [
                "contract" => "kujira1pwldj8n88f99wl5sykff9q7sl2settejutlr84mjysny9wfqgluqcp6fu4",
                "nominative" => "MNTA_USDC"
            ],
            "wFTM_MNTA" => [
                "contract" => "kujira1dsmm4q4kgs0nfsryrmlv7wq2dxp6uzruzqalc5xp30ztlmplgm7qms2qsa",
                "nominative" => "MNTA_USDC"
            ],

            // *** KUJI PAIRS
            "ampKUJI_KUJI" => [
                "contract" => "kujira1lse59wt7a5yksdd08mennt299katjkfzdhmh8hvck8ln08jktcmsxrnh8s",
                "nominative" => "KUJI_USDC"
            ],
            "wETH_KUJI" => [
                "contract" => "kujira1zdf0zjz8grfhhe2x06k8f8xpnv04y90w06f4py7fjml4nmukn3yswk3ugc",
                "nominative" => "KUJI_USDC"
            ],
            "wBTC_KUJI" => [
                "contract" => "kujira17t9w0xlnukuy7pw6fzkr7gd3pdun9zma0hzqaueqszskw2lr95yqfqnynt",
                "nominative" => "KUJI_USDC"
            ],
            "MNTA_KUJI" => [
                "contract" => "kujira1nkgq8xl4flsau7v3vphr3ayc7tprgazg6pzjmq8plkr76v385fhsx26qfa",
                "nominative" => "KUJI_USDC"
            ],

            // *** ATOM PAIRS
            "KUJI_ATOM" => [
                "contract" => "kujira18v47nqmhvejx3vc498pantg8vr435xa0rt6x0m6kzhp6yuqmcp8s4x8j2c",
                "nominative" => "ATOM_USDC"
            ],
            "stATOM_ATOM" => [
                "contract" => "kujira158zzjcvkz7r3j5hueurcw22qrjerqw4dtrzlalztr7whjykjwvrsrahdnq",
                "nominative" => "ATOM_USDC"
            ],
            "LP KUJI_ATOM (ATOM)" => [
                "contract" => "kujira1gl8js9zn7h9u2h37fx7qg8xy65jrk9t4zpa6s7j5hdlanud2uwxshqq67m",
                "nominative" => "ATOM_USDC"
            ],
            "LP KUJI_ATOM (KUJI)" => [
                "contract" => "kujira1hs95lgvuy0p6jn4v7js5x8plfdqw867lsuh5xv6d2ua20jprkgesw2pujt",
                "nominative" => "KUJI_USDC"
            ],

            // *** LUNA PAIRS
            "KUJI_LUNA" => [
                "contract" => "kujira1xqhakgvn3jeqfade0z4aufer9xylx7ft45fgyhg6z75mauhkjwks9cucyq",
                "nominative" => "LUNA_USDC"
            ],
            "ampLUNA_LUNA" => [
                "contract" => "kujira172qjrk8g9l86w0shz4cc3e6rt5h9janaen4j4u6ze7xkjvjnaqfskwyyqm",
                "nominative" => "LUNA_USDC"
            ],

            // *** OSMO PAIRS
            "ATOM_OSMO" => [
                "contract" => "kujira1hulx7cgvpfcvg83wk5h96sedqgn72n026w6nl47uht554xhvj9nsra5j5u",
                "nominative" => "OSMO_USDC"
            ],

           //  *** wETH PAIRS
            "wstETH_wETH" => [
                "contract" => "kujira1ehwsdvgs3chpxuexktymjmmjj68m3h4q67p9vjj9rrgjqycc3gtsfzej24",
                "nominative" => "wETH_USDC",
                "decimals" => 18
            ]
        ];

        foreach ($finContracts as $tickerId => $contractValues) {
            $this->finContracts[] = new FinContract(
                $contractValues["contract"],
                $tickerId,
                $contractValues['decimals'] ?? 6,
                $contractValues['nominative'] ?? null
            );
        }
    }

    public function findAll(): FinContracts
    {
        return new FinContracts($this->finContracts);
    }

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract
    {
        $finContracts = $this->findAll();

        foreach ($finContracts as $finContract) {
            if ($finContract->tickerId() === $tickerId->value()) {
                return $finContract;
            }
        }

        return null;
    }
}
