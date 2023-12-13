<?php

namespace App\Service;

class ApplicationGlobalsService
{
    private ?array $USKMintedEndpoints = [
        'ATOM' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1ecgazyd0waaj3g7l9cmy5gulhxkps2gmxu9ghducvuypjq68mq2smfdslf/smart/eyJzdGF0dXMiOnt9fQ==',
        'DOT' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1eydneup86kyhew5zqt5r7tkxefr3w5qcsn3ssrpcw9hm4npt3wmqa7as3u/smart/eyJzdGF0dXMiOnt9fQ==',
        'wETH' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1fjews4jcm2yx7una77ds7jjjzlx5vgsessguve8jd8v5rc4cgw9s8rlff8/smart/eyJzdGF0dXMiOnt9fQ==',
        'wBNB' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1f2jt3f9gzajp5uupeq6xm20h90uzy6l8klvrx52ujaznc8xu8d7s6av27t/smart/eyJzdGF0dXMiOnt9fQ==',
        'LUNA' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1r80rh4t7zrlt8d6da4k8xptwywuv39esnt4ax7p7ca7ga7646xssrcu5uf/smart/eyJzdGF0dXMiOnt9fQ==',
        'gPAXG' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1twc28l5njc07xuxrs85yahy44y9lw5euwa7kpajc2zdh98w6uyksvjvruq/smart/eyJzdGF0dXMiOnt9fQ==',
        'stATOM' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira19kl9ma0u7e9vdhw54mjahh052hcdwzpxmm840phffrff7v3perjsqxfajc/smart/eyJzdGF0dXMiOnt9fQ==',
        'stOSMO' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1x5yjm80asepzk5w8gaswux6vul7pgpjl90q3j58xzjajls7s4kjq3vnzy9/smart/eyJzdGF0dXMiOnt9fQ==',
        'ARB' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1wgxks9jwla3q6axpk0vjg89ujvet9t94dd0xtqueqjx59g46e4zq4mvd9a/smart/eyJzdGF0dXMiOnt9fQ==',
        'wBTC' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1f6jl29tsrzevdluc74kqzs7v2mrkc86sq2cxd4v4wr7y6hl8qggswnwndn/smart/eyJzdGF0dXMiOnt9fQ==',
        'wAVAX' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1mjj8u6c5a0lj6d2ee2ayd5eehwu2ekpjgghqjwaqtzekx5vd8ngq8nwj5r/smart/eyJzdGF0dXMiOnt9fQ==',
        'wFTM' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1emyuyf9thxkus7rzveqmn6snv46v98pv86vc5mxhrw5tqqqc7wxqzpe2xx/smart/eyJzdGF0dXMiOnt9fQ==',
        'wMATIC' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1zc3a6ncr4lajr9du6chuxwef34l8ppj9h8x0yc3fslkk82da9m2sajlmv2/smart/eyJzdGF0dXMiOnt9fQ==',
        'INJ' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1t474kt3hu0zpn6f989wnn794vvymud6hc6rdgxg20l45mc5agheq029t9s/smart/eyJzdGF0dXMiOnt9fQ==',
        'LINK' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1ejp24ehnh6nh3mueseanksffn7us5cezq29p52vlfc069gszf6dqvngdpe/smart/eyJzdGF0dXMiOnt9fQ==',
        'wstETH' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1k8q4h6k0z7n3vlc2nl339r40cxy9q5qp09swxkgdfhy23nfwe8yqcf04w6/smart/eyJzdGF0dXMiOnt9fQ==',
        'ATOM-Margin' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1m0z0kk0qqug74n9u9ul23e28x5fszr628h20xwt6jywjpp64xn4qkxmjq3/smart/eyJzdGF0dXMiOnt9fQ==',
        'wBNB-Margin' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1pep6vkkjexjlsw3y5h4tj27g7s58vkypy8zg7f9qdvlh2992pncqduz84n/smart/eyJzdGF0dXMiOnt9fQ==',
        'DOT-Margin' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1hjyjafrt09p4hwsnwch29nrrs40lprfgesqdy44wnp27td872hsse2rree/smart/eyJzdGF0dXMiOnt9fQ==',
        'wETH-Margin' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1m4ves3ymz5hyrj3war3t7uxu9ewt8rwpunja87960n0gre3a5pzspgry4g/smart/eyJzdGF0dXMiOnt9fQ==',
        'LUNA-Margin' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1722g2rudg0rlw45nuuvjhg4a365xztfrdfjgyyfuzlmqmtu2plas34y6x3/smart/eyJzdGF0dXMiOnt9fQ==',
        'MNTA' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1247c0yvkxf3sf4zzu88sye5aqpqckjsmllk78uk3a89ezermldcs6ldxx2/smart/eyJzdGF0dXMiOnt9fQ==',
        'STARS' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira1ur46evrz7jx7qq2rnxuzugvq04sq9pzwrja0j0kz3urj88wraezsdr2ala/smart/eyJzdGF0dXMiOnt9fQ==',
        'SOMM' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira17lygr9z479rrslsg6rm8elutgcrt2lze4nqjlwsrvqud4hdx6mdqxa7huu/smart/eyJzdGF0dXMiOnt9fQ==',
    ];

    private ?array $fin_contracts = [

//        //AXL USDC pairs
        "KUJI_axlUSDC"      =>  ["contract" => "kujira14hj2tavq8fpesdwxxcu44rty3hh90vhujrvcmstl4zr3txmfvw9sl4e867"],
        "JUNO_axlUSDC"      =>  ["contract" => "kujira1z7asfxkwv0t863rllul570eh5pf2zk07k3d86ag4vtghaue37l5s9epdvn"],
        "EVMOS_axlUSDC"     =>  ["contract" => "kujira182nff4ttmvshn6yjlqj5czapfcav9434l2qzz8aahf5pxnyd33tsz30aw6"],
        "wETH_axlUSDC"      =>  ["contract" => "kujira1suhgf5svhu4usrurvxzlgn54ksxmn8gljarjtxqnapv8kjnp4nrsqq4jjh", "priceMultiplier" => 1000000000000],
        "axlUSDT_axlUSDC"   =>  ["contract" => "kujira1xut80d09q0tgtch8p0z4k5f88d3uvt8cvtzm5h3tu3tsy4jk9xlscem692"],
        "xAVAX_axlUSDC"     =>  ["contract" => "kujira1qjxu65ucccpg8c5kac8ng6yxfqq85fluwd0p9nt74g2304qw8eyq930y7w", "priceMultiplier" => 1000000000000],
        "STARS_axlUSDC"     =>  ["contract" => "kujira1jkte0pytr85qg0whmgux3vmz9ehmh82w40h8gaqeg435fnkyfxqq5m32qy"],
        "LOOP_axlUSDC"      =>  ["contract" => "kujira10fqy0npt7djm8lg847v9rqlng88kqfdvl8tyt4ge204wf52sy68qwmj07l"],
        "CMDX_axlUSDC"      =>  ["contract" => "kujira16y344e8ryydmeu2g8yyfznq79j7jfnar4p59ngpvaazcj83jzsms6tju67"],
        "ATOM_axlUSDC"      =>  ["contract" => "kujira1xr3rq8yvd7qplsw5yx90ftsr2zdhg4e9z60h5duusgxpv72hud3sl8nek6"],
        "OSMO_axlUSDC"      =>  ["contract" => "kujira1aakfpghcanxtc45gpqlx8j3rq0zcpyf49qmhm9mdjrfx036h4z5sfmexun"],
        "SCRT_axlUSDC"      =>  ["contract" => "kujira1fkwjqyfdyktgu5f59jpwhvl23zh8aav7f98ml9quly62jx2sehysqa4unf"],
        "LUNA_axlUSDC"      =>  ["contract" => "kujira1yg8930mj8pk288lmkjex0qz85mj8wgtns5uzwyn2hs25pwdnw42skp0kur"],
        "wBNB_axlUSDC"      =>  ["contract" => "kujira1apkgj87fgfsq84swvkyfaemrq7t4deuh60887lek0hkgdjh5fj0qaz7fhx", "priceMultiplier" => 1000000000000],
        "DOT_axlUSDC"       =>  ["contract" => "kujira1w4t2qpwvhyhz0g2mwgqjzgsw63dcy5hkfch0tgr8xj9qjcsauq8q5x0zxz", "priceMultiplier" => 10000],
        "gPAxG_axlUSDC"     =>  ["contract" => "kujira12p30cr4gstmp2yucwxtaq92turrzsxxar8upz3rhmfjxh6gdgk4s5vsyse", "priceMultiplier" => 1000000000000],
        "MARS_axlUSDC"      =>  ["contract" => "kujira149m52kn7nvsg5nftvv4fh85scsavpdfxp5nr7zasz97dum89dp5qevttd9"],
        "wTAO_axlUSDC"      =>  ["contract" => "kujira17qp8g5n5wwelrsnfdakrv0p550nzg72agpcz5t0ea6thlqd300hquxljcc", "priceMultiplier" => 1000000000000],
        "MNTA_axlUSDC"      =>  ["contract" => "kujira1ws9w7wl68prspv3rut3plv8249rm0ea0kk335swye3sl2slld4lqdmc0lv"],
        "NTRN_axlUSDC"      =>  ["contract" => "kujira1kt0jxlr5fkx3xepymxav5c3h8sjnmutp3za2e6r5k9pgsta34trq8emzqj"],

// USDC PAIRS
"KUJI_USDC"     =>  ["contract" => "kujira1pw96huy6z02uk8hdpruk6g8u700dp8yxjhp46c24rwkzay2lfd3quqdum5"],
"axlUSDC_USDC"  =>  ["contract" => "kujira1zg4e37hz5hzlf8kmcaxjf85nyevk3qr2dp307lafdgst2928rghqed59ed"],
"MNTA_USDC"     =>  ["contract" => "kujira16mnw6am32ecqacsgz2kf9gfy8sh4uqyv0246f3rxnjz4up9k462q34jck5"],
"gUSDC_USDC"    =>  ["contract" => "kujira1m7jfsvnsa7k2v6vaettc86tlvrzjpn96dr2pyfd7pcf0ze9gnccsv7eh6s"],

//USK PAIRS
"ATOM_USK"      =>  ["contract" => "kujira1yum4v0v5l92jkxn8xpn9mjg7wuldk784ctg424ue8gqvdp88qzlqr2qp2j"],
"KUJI_USK"      =>  ["contract" => "kujira193dzcmy7lwuj4eda3zpwwt9ejal00xva0vawcvhgsyyp5cfh6jyq66wfrf"],
"axlUSDC_USK"   =>  ["contract" => "kujira1rwx6w02alc4kaz7xpyg3rlxpjl4g63x5jq292mkxgg65zqpn5llq202vh5"],
"AXL_USK"       =>  ["contract" => "kujira1dtaqwlmzlk3jku5un6h6rfunttmwsqnfz7evvdf4pwr0wypsl68q49aaud"],
"CRO_USK"       =>  ["contract" => "kujira10j648ftg2g8p5vhgsu5kzfh6d907vpkrn0a5l3qch479eqy2qssqm905c4"],
"LUNA_USK"      =>  ["contract" => "kujira1zz74gvmq6ss3pg5vgahvx47ugpfzr80qu75l97lf2ggdgxq04ddqxkdzey"],
"wBNB_USK"      =>  ["contract" => "kujira1a0fyanyqm496fpgneqawhlsug6uqfvqg2epnw39q0jdenw3zs8zqsjhdr0", "priceMultiplier" => 1000000000000],
"STRD_USK"      =>  ["contract" => "kujira1cn922pcqrt4g2dr4va9vxk8h3w3jfxnxjqq2qp6zktjsehdzde6sz66um0"],
"LOCAL_USK"     =>  ["contract" => "kujira1sse6a00arh9dalzsyrd3q825dsn2zmrag0u4qx8q0dyks4ftnxyqrj0xds"],
"wMATIC_USK"    =>  ["contract" => "kujira1rrnacml8zeqq3ve2t98r5x88t4uahahdk66y9qpcrjp9qxhnuvysv59zx8", "priceMultiplier" => 1000000000000],
"wBTC_USK"      =>  ["contract" => "kujira1ulyrqqtx9vqsk92805jk7xxwz77lszmm2f548juyced96tj4lg7qugewsf"],
"USDC_USK"      =>  ["contract" => "kujira1zg4e37hz5hzlf8kmcaxjf85nyevk3qr2dp307lafdgst2928rghqed59ed"],
"WINK_USK"      =>  ["contract" => "kujira1qxtd87qus6uzvqs4jv9r0j9ccd4yla42s6qag7y8fp7hhv68nzas6hqxgw"],
"NSTK_USK"      =>  ["contract" => "kujira1ggtmfuktfcf6plhtdejyyqn5de5uge3tef0jv64ru68h2ctuvyqs3355mn"],
"FUZN_USK"      =>  ["contract" => "kujira1w6gpsfn55ufh3g3pf6qjrdhfj6rp09zqmruvgvzupkl39mtlpcdqw2ys7e"],
"MNTA_USK"      =>  ["contract" => "kujira1mf4v3x3pkuthha5a4r9jd0slgulcxkucy4weuqsvx2n030twduzqewuznf"],
"NTRN_USK"      =>  ["contract" => "kujira18vzzgwgc4c7mehenjllxvsnydg3gch0a63pedxl4ldrr6gexvyfqk7kupd"],
"SCRT_USK"      =>  ["contract" => "kujira1rpxf55u22q2tly9y8rgdrjgx9p52sus7jugaevj3hdt0z7sgvkcsyrhrv0"],
"SHD_USK"       =>  ["contract" => "kujira1cduudfszcm9slm8qxlaqvnpzg2u0hkus94fe3pwt9x446dtw6eeql8ualz"],
"STARS_USK"     =>  ["contract" => "kujira1nm3yktzcgpnvwu6qpzqgl2ktyvlgsstc7ev849dd3ulaygw75mqqxvtnck"],
"wETH_USK"      =>  ["contract" => "kujira17w9r23r8v8r7z5lphwj99296fhlye9ej5nq3hlqw554u63m88avspdl9tc", "priceMultiplier" => 1000000000000],
"FURY_USK"      =>  ["contract" => "kujira1v8lkqws3gd6npr0rdk9ch54amh9guas86r4u62jq27hee88lryfsxwrvlk"],
"ampLUNA_USK"   =>  ["contract" => "kujira1uvqk5vj9vn4gjemrp0myz4ku49aaemulgaqw7pfe0nuvfwp3gukq64r3ws"],
"AQUA_USK"      =>  ["contract" => "kujira13l8gwanf37938wgfv5yktmfzxjwaj4ysn4gl96vj78xcqqxlcrgssfl797"],
"DOT_USK"       =>  ["contract" => "kujira1jlzw6xal0n2c580g3wxs09tjhlzdht9y8dgszq3tupf8fhl7xjus7ep7ap", "priceMultiplier" => 10000],
"CMDX_USK"      =>  ["contract" => "kujira1h7eenquygffwsmc8csrlx88zcddwx0aqspq3x2dsl20lwk4r9n2q9t86ht"],
"wAVAX_USK"     =>  ["contract" => "kujira1fphguznhazgqdlr9mpfh6nmn3vjjr73ksz3ukznv6q7s9ndfq2cs8vhapj", "priceMultiplier" => 1000000000000],
"CMST_USK"      =>  ["contract" => "kujira1qw5hdcmcf4aq5xmnu6znscurvkgvhxfsyvhz3jvxhasxjwtk3l7sccwcs8"],
"wFTM_USK"      =>  ["contract" => "kujira1ky9kv2m4dnykm90d0lj5089k4efttgfpx34zyvkklxnew48c522sggqjsg"],
"gPAxG_USK"     =>  ["contract" => "kujira1rtpn4nxkx7u5y4uf5lp4ywrhmnms07p8p8wc3pmw53hfv0lhyxdqlfhgrt", "priceMultiplier" => 1000000000000],
"DAI_USK"       =>  ["contract" => "kujira18lm235jzuh4t7hh5z8lqyz08dmz67magj8z0fc4a0vn6c0hzk0es3r4glx", "priceMultiplier" => 1000000000000],
"wTAO_USK"      =>  ["contract" => "kujira1538ukswznmuek3hfv7mcxem9hjqz8sa4ypl2ul0zncu3tdgfvwmq8pxkwp", "priceMultiplier" => 1000000000000],
"MARS_USK"      =>  ["contract" => "kujira1v8kh6mqxq7awcvl936xeyzv8fnmdkd3yxggvkyek5d0ecut4a6zs0larj2"],
"CNTO_USK"      =>  ["contract" => "kujira1642dp8q7gzm5g5csdz2k676rc5zqfka4hfnas9ffydffp0saspts0e9zgp"],
"GRAV_USK"      =>  ["contract" => "kujira18638dsuf7p3a2e23seqz8zegqrcpsdr5nw6j2a50qg6r3q8vn3qqrg9lzp"],
"INJ_USK"       =>  ["contract" => "kujira1ddeadmhum3umygv84frhc87gl2grzjmx9x8fuhjts7zqwuc39xuq53w3d8"],
"WHALE_USK"     =>  ["contract" => "kujira1x38mke7q0qut5lku4zrx7wgjrsj9jn3tffadegzzcsy9s5w5mdmqzzl0sn"],
"ACRE_USK"      =>  ["contract" => "kujira1zumrlzj7ffq0murckuzykgsvcn3xzyvn3e85fxjsymwyhezmkycqtq87zj"],
"xASTRO_USK"    =>  ["contract" => "kujira1qwtjeaf0y6hn094gn3xprw7wknkl4egpkr7dqu3cljkev5ex4xfqf2h8uc"],
"SWTH_USK"      =>  ["contract" => "kujira1aqnmhyu37ynf8pm0fedtykzf3clk25ecc0p23cce2d5dc59eteeqgrg6tv"],
"PLANQ_USK"     =>  ["contract" => "kujira1q7p9wldxxvnqda4hx8w6caplqj33tfxne5efjamsp6ruhuk3knwqwjuhrn"],
"DVPN_USK"      =>  ["contract" => "kujira1ullqzk95uh0derdqpp8e5f4ukdun00xdal486zmjeeqsfhefgd0qh0qndl"],
"ROAR_USK"      =>  ["contract" => "kujira1vllmvr0ylegpgg34y727kmys4yy3kjjnwj8xt3j22mdc5u4z7egs5d0sg8"],
"AKT_USK"       =>  ["contract" => "kujira1ppr63x265m0sgqdhl2k23t8hmfcgrar85rxgq45uvctksr8w8hzsqwwdcq"],
"ARB_USK"       =>  ["contract" => "kujira1zf94p6srpmlk0d5p9pwpqqwztynd22mndqljqvral604k8jfcw4sw2y7kp"],
"CRE_USK"       =>  ["contract" => "kujira1nu8kef49y0pdrkphtkt857tgtt0pe8nr8ms0pnp6lylrav9jq2asmjljhe"],
"FLIX_USK"      =>  ["contract" => "kujira1uau4ctnpfze4qqljqgup3watfg9yvmkgr7gevzgv27g30yx56fvsr6dkqx"],
"LUNC_USK"      =>  ["contract" => "kujira10lzmqlvey89gwd4jz8aq3s4xdllk2k56yj45cex9s86v8g7nkpmq24djj4"],
"MNTL_USK"      =>  ["contract" => "kujira1vpvt27kwaasyfxyd9lkfu3xlm3axmayg40z8reas7l7nk659kcqsgywtdv"],
"stOSMO_USK"    =>  ["contract" => "kujira1tnnvtvere0pwz0uupy4crl3dv6yszte9nqms4fwmfhj3e2yl477sa0frks"],
"PLQ_USK"       =>  ["contract" => "kujira1q7p9wldxxvnqda4hx8w6caplqj33tfxne5efjamsp6ruhuk3knwqwjuhrn"],
"RAC_USK"       =>  ["contract" => "kujira1kmw6fk5p7an27u8f3er08xrwvzlehczymgshkqxzfrxyrfleu2eqxykaln"],
"REGEN_USK"     =>  ["contract" => "kujira1p2vmq7g8fghkeak0hz4qfgeskkd7zqp3vnj6m3sa0r6gp4dr37usmtgtej"],
"SOMM_USK"      =>  ["contract" => "kujira1wckallump2k4284pt5wqg63a8prr205y532ym3850l82k75yzems5mfnkj"],
"LINK_USK"      =>  ["contract" => "kujira12zjpumtfh88k6s2s8k4wks37ezr2c3zeha5xx6qpd65e5ehz50nq0afvrv", "priceMultiplier" => 1000000000000],
//
//// MNTA PAIRS
"stATOM_MNTA"   =>  ["contract" => "kujira1l2x5c2fjjnw9uhrfhtme9snw3tzs4jt8cm0q2ysqssx6zskxatesjm7w7f", "nominative" => "MNTA_axlUSDC"],
"wstETH_MNTA"   =>  ["contract" => "kujira1hf44at7dqewrn3ssa392d9p8nh5mr538u59gqsukdza35663hlestqr29e", "nominative" => "MNTA_axlUSDC"],
"wETH_MNTA"     =>  ["contract" => "kujira13xyuyw93pv6t7c4h248tc8t6kgu874v5qasmjfzqjfjhfp6hawlse5u5tz", "nominative" => "MNTA_axlUSDC"],
"STARS_MNTA"    =>  ["contract" => "kujira1hsdzhyvuc2z3f8d3yae84uk62d69vk68vxgudkun7gccz6hvrvfq0vx6fd", "nominative" => "MNTA_axlUSDC"],
"wBTC_MNTA"     =>  ["contract" => "kujira1y50nul39ql5sf42p67nrsy9j0luly2mvaxmlkmx6888pnzw66k6qc0gku9", "nominative" => "MNTA_axlUSDC"],
"OSMO_MNTA"     =>  ["contract" => "kujira12zc52j25xac565t297rmd3huj8zh62usrecy66rzxnsf9mchaepqnwx3cg", "nominative" => "MNTA_axlUSDC"],
"SOMM_MNTA"     =>  ["contract" => "kujira1nx5lqc2j4w0ak5dxevj82lar5kunxwj5yamr39xqfazmkksx4f2sksf0hz", "nominative" => "MNTA_axlUSDC"],
"yieldETH_MNTA" =>  ["contract" => "kujira1sr2hf68nc8a8f2e42tsjf3zmsgjkl4jmctszdzxes0whyk2tzn5sd3avg7", "nominative" => "MNTA_axlUSDC"],
"STRD_MNTA"     =>  ["contract" => "kujira1u2gj9a6p07hse07p66jqnq7xchneecxrq032vl4z2z97ft2r0zeqx4hadf", "nominative" => "MNTA_axlUSDC"],
"SHD_MNTA"      =>  ["contract" => "kujira14u8ynhj7d8h2379yqj5q2ma0xxpvfjlrpauhzxgnj40ejq953mlsugux8d", "nominative" => "MNTA_axlUSDC"],
"INJ_MNTA"      =>  ["contract" => "kujira17356flrg56cjs7ardg0c6jpufwyeafegss6l4asza4chrr0ne7aqfesynu", "nominative" => "MNTA_axlUSDC"],
"AXL_MNTA"      =>  ["contract" => "kujira17r5u5r9gl3p9lql7p4dhdcffnv2z0f4xxafvgl8wnhw8qeez4x6q9zflp7", "nominative" => "MNTA_axlUSDC"],
"AKT_MNTA"      =>  ["contract" => "kujira1krepsjxnpesa5u2amklew60r6zgtrmt9h2ljx8dnzljp0wxcstnqxfy0tk", "nominative" => "MNTA_axlUSDC"],
"NTRN_MNTA"     =>  ["contract" => "kujira1hcvm4thkc0mq55cjzttp0fmh6gu5hzrfm4trgwpkm38nmd63tu0qha647q", "nominative" => "MNTA_axlUSDC"],
"WINK_MNTA"     =>  ["contract" => "kujira19rmgf792tgl446fnyc4wjdj2t20jlt5t3wudxyuhfy2ccy67g0hsrt73d8", "nominative" => "MNTA_axlUSDC"],
"WHALE_MNTA"    =>  ["contract" => "kujira1865zmuchjd0g0xr2q5n6hm747s8xju5k8h6mympk4vmqefkuy3hqc66tcw", "nominative" => "MNTA_axlUSDC"],
"UMEE_MNTA"     =>  ["contract" => "kujira180qesrskvljsvvkhvlkrwvyvu5hx03jhx76lvwxveq86at4ttqxq259wz8", "nominative" => "MNTA_axlUSDC"],
"TIA_MNTA"      =>  ["contract" => "kujira1vwr998s2mmvqa0t2tlfayvv5uzsl7t4syxd7a94qdgstfy4720rsa3n9yp", "nominative" => "MNTA_axlUSDC"],
"wTAO_MNTA"     =>  ["contract" => "kujira1tgd479qm2cu30yr4568l23aaz0p2wcr979wx3z7wlsgcc5fj6rxshc2uwx", "nominative" => "MNTA_axlUSDC"],
"whSOL_MNTA"    =>  ["contract" => "kujira1tdad4e3c6qz6htdha4wg4ta6l86chnpyy22rfm60e6luj4wv2casjsrtj0", "nominative" => "MNTA_axlUSDC"],
"SCRT_MNTA"     =>  ["contract" => "kujira1y5k75yuygkr9wmpl3huy5spqktgq9w2ex3zndu0zw6l2n0mzf4asz7hdat", "nominative" => "MNTA_axlUSDC"],
"NTSK_MNTA"     =>  ["contract" => "kujira1ff9pnz3ekflj6vkyk2taf4tvvjh4a8fp8hetw3dc59xu8ywl8tmstcf9de", "nominative" => "MNTA_axlUSDC"],
"ampMNTA_MNTA"  =>  ["contract" => "kujira1pwldj8n88f99wl5sykff9q7sl2settejutlr84mjysny9wfqgluqcp6fu4", "nominative" => "MNTA_axlUSDC"],
"wFTM_MNTA"     =>  ["contract" => "kujira1dsmm4q4kgs0nfsryrmlv7wq2dxp6uzruzqalc5xp30ztlmplgm7qms2qsa", "nominative" => "MNTA_axlUSDC"],

//KUJI PAIRS
"ampKUJI_KUJI"  =>  ["contract" => "kujira1lse59wt7a5yksdd08mennt299katjkfzdhmh8hvck8ln08jktcmsxrnh8s", "nominative" => "KUJI_axlUSDC"],
"wETH_KUJI"     =>  ["contract" => "kujira1zdf0zjz8grfhhe2x06k8f8xpnv04y90w06f4py7fjml4nmukn3yswk3ugc", "nominative" => "KUJI_axlUSDC"],
"wBTC_KUJI"     =>  ["contract" => "kujira17t9w0xlnukuy7pw6fzkr7gd3pdun9zma0hzqaueqszskw2lr95yqfqnynt", "nominative" => "KUJI_axlUSDC"],
"MNTA_KUJI"     =>  ["contract" => "kujira1nkgq8xl4flsau7v3vphr3ayc7tprgazg6pzjmq8plkr76v385fhsx26qfa", "nominative" => "KUJI_axlUSDC"],
//
// ATOM PAIRS
"KUJI-ATOM"             => ["contract" => "kujira18v47nqmhvejx3vc498pantg8vr435xa0rt6x0m6kzhp6yuqmcp8s4x8j2c", "nominative" => "ATOM_axlUSDC"],
"stATOM_ATOM"           => ["contract" => "kujira158zzjcvkz7r3j5hueurcw22qrjerqw4dtrzlalztr7whjykjwvrsrahdnq", "nominative" => "ATOM_axlUSDC"],
"LP KUJI-ATOM (ATOM)"   => ["contract" => "kujira1gl8js9zn7h9u2h37fx7qg8xy65jrk9t4zpa6s7j5hdlanud2uwxshqq67m", "nominative" => "ATOM_axlUSDC"],
"LP KUJI-ATOM (KUJI)"   => ["contract" => "kujira1hs95lgvuy0p6jn4v7js5x8plfdqw867lsuh5xv6d2ua20jprkgesw2pujt", "nominative" => "KUJI_axlUSDC"],

// LUNA PAIRS
"KUJI-LUNA" => ["contract" => "kujira1xqhakgvn3jeqfade0z4aufer9xylx7ft45fgyhg6z75mauhkjwks9cucyq", "nominative" => "LUNA_axlUSDC"],
"ampLUNA_LUNA" => ["contract" => "kujira172qjrk8g9l86w0shz4cc3e6rt5h9janaen4j4u6ze7xkjvjnaqfskwyyqm", "nominative" => "LUNA_axlUSDC"],

//OSMO PAIRS
"ATOM-OSMO" => ["contract" => "kujira1hulx7cgvpfcvg83wk5h96sedqgn72n026w6nl47uht554xhvj9nsra5j5u", "nominative" => "OSMO_axlUSDC"],

// WETH PAIRS

"wstETH_wETH" => ["contract" => "kujira1ehwsdvgs3chpxuexktymjmmjj68m3h4q67p9vjj9rrgjqycc3gtsfzej24", "nominative" => "wETH_axlUSDC", "ethDivider" => 1]
    ];

    private ?array $api_urls = [
        'staked_tokens' => 'https://lcd.kaiyo.kujira.setten.io/cosmos/staking/v1beta1/pool',
        'list_of_pairs' => 'https://api.kujira.app/api/coingecko/pairs',
        'transactions' => 'https://kaiyo-1.gigalixirapp.com/api/txs/count',
        'tickers' => 'https://api.kujira.app/api/coingecko/tickers',
        'community_pool' => 'https://lcd.kaiyo.kujira.setten.io/cosmos/distribution/v1beta1/community_pool',
        'wallets' => 'https://lcd.kaiyo.kujira.setten.io/cosmos/auth/v1beta1/accounts?pagination.limit=1&pagination.count_total=true',
        'APR' => 'https://api.kujira.app/api/kuji/rewards?diff=1099636&address=kujira1xe0awk5planmtsmjel5xtx2hzhqdw5p8z66yqd',
        'bw_vault' => 'https://blackwhale.money/mainnet/api/vaults',
        'fin_contracts_5' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/code/5/contracts',
        'fin_contracts_4' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/code/4/contracts',
        'fin_contracts_3' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/code/3/contracts',
        'fin_contracts_2' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/code/2/contracts',
        'total_value_locked' => 'https://lcd.kaiyo.kujira.setten.io/cosmos/bank/v1beta1/balances/',
        'contracts' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/',
        'unmigrated' => 'https://kaiyo-1.gigalixirapp.com/api/kuji/vesting',
        'base_url' => 'https://kaiyo-1.gigalixirapp.com/api',
        'ghostKUJIUSK' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1aakur92cpmlygdcecruk5t8zjqtjnkf8fs8qlhhzuy5hkcrjddfs585grm/smart/eyJzdGF0dXMiOnt9fQ==',
        'ghostUSKKUJI' => 'https://lcd.kaiyo.kujira.setten.io/cosmwasm/wasm/v1/contract/kujira1fpqcnev8dq6cd9pkum3wnt4jraxjeflmjcr9xqush2fr4ke4aupq6d3c6h/smart/eyJzdGF0dXMiOnt9fQ==',
        'MantaFees' => 'https://api.kujira.app/api/txs?q=kujira1fx4a4wzh4v247laumjllkkw8r692drdj65m5wrcsglydqyrdjq5s57a89f&limit=10&offset=0&order_by=rowid&order_dir=desc',
        'MantaStaked' => 'https://rest.cosmos.directory/kujira/cosmwasm/wasm/v1/contract/kujira12y9ltc6a0vnlce6dkdmkv23jm6euu3zgvnwcwlggd42wgexyvh2srr8r5q/smart/ewogICAgICAgICJ0b3RhbF93ZWlnaHQiOiB7CiAgICAgICAgfQogICAgfQ==',
        'Mantalocked' => 'https://lcd.kaiyo.kujira.setten.io/cosmos/bank/v1beta1/balances/kujira12y9ltc6a0vnlce6dkdmkv23jm6euu3zgvnwcwlggd42wgexyvh2srr8r5q'
    ];
    private ?array $tokens = [
        'wETH' => 'ibc/1B38805B1C75352B28169284F96DF56BDEBD9E8FAC005BDCC8CF0378C82AA8E7',
        'ATOM' => 'ibc/27394FB092D2ECCD56123C74F36E4C1F926001CEADA9CA97EA622B25F41E5EB2',
        'axlUSDC' => 'ibc/295548A78785A1007F232DE286149A6FF512F180AF5657780FC89C009E2C348F',
        'OSMO' => 'ibc/47BD209179859CDE4A2806763D7189B6E6FE13A17880FE2B42DE1E6C1E329E23',
        'JUNO' => 'ibc/EFF323CC632EC4F747C61BCE238A758EFDB7699C3226565F7C20DA06509D59A5',
        'EVMOS' => 'ibc/F3AA7EF362EC5E791FE78A0F4CCC69FEE1F9A7485EB1A8CAB3F6601C00522F10',
        'KUJI' => 'ukuji',
        'LUNA' => 'ibc/DA59C009A0B3B95E0549E6BF7B075C8239285989FF457A8EDDBB56F10B2A6986',
        'SCRT' => 'ibc/A358D7F19237777AF6D8AD0E0F53268F8B18AE8A53ED318095C14D6D7F3B2DB5',
        'axlUSDT' => 'ibc/F2331645B9683116188EF36FC04A809C28BD36B54555E8705A37146D0182F045',
        'USK' => 'factory/kujira1qk00h5atutpsv900x202pxx42npjr9thg58dnqpa72f2p7m2luase444a7/uusk',
        'AXL' => 'ibc/C01154C2547F4CB10A985EA78E7CD4BA891C1504360703A37E1D7043F06B5E1F',
        'CRO' => 'ibc/BBC45F1B65B6D3C11C3C56A9428D38C3A8D03944473791C52DFB7CD3F8342CBC',
        'wAVAX' => 'ibc/004EBF085BBED1029326D56BE8A2E67C08CECE670A94AC1947DF413EF5130EB2',
        'STARS' => 'ibc/4F393C3FCA4190C0A6756CE7F6D897D5D1BE57D6CCB80D0BC87393566A7B6602',
        'LOOP' => 'ibc/8318B7E036E50C0CF799848F23ED84778AAA8749D9C0BCD4FF3F4AF73C53387F',
        'CMDX' => 'ibc/3607EB5B5E64DD1C0E12E07F077FF470D5BC4706AFCBC98FE1BA960E5AE4CE07',
    ];

    private ?array $bow_contracts = [
        'ampLUNA/USK' => 'kujira14qpyduhanevay6rhk3z308nwjxa83a8x37kmn5rct5x6kszj3gmqpuq7m6',
        'AQUA/USK' => 'kujira1kupjzlp96l4ypt0fdpse8slmkdkkz3g0t5evy033va0gvtw867sq0cm6q0',
        'ASTRO/USK' => 'kujira1kgpsdn4gh24fpe5n8k4tvs5wn5s8w6825ewexkk7j2hq4467hf5s7qc23l',
        'ATOM/axlUSDC' => 'kujira14wv3whn3v9sgf8r0dm7a46v7m7pukhs87x73e0ude3ktuzztfj9qxndumz',
        'ATOM/USK' => 'kujira1yncutssgh2vj9scaymtteg949hwcft07c6qmgarxnaf04yesq3jsn6g2uv',
        'AXL/USK' => 'kujira1nxfag552cng6lwf2q3duyepgvenr670ngj8uljpeydy0rvftgt9qkgd6sq',
        'axlUSDC/USK' => 'kujira12506pfme6layua70svszn2xza0pt9mnqu2u24lszrdyywmpvnw5qfz8sfq',
        'CRO/USK' => 'kujira1zr5ywldgav8tnlplw9wnu7evp66xvp3ttymdg2jnfgaktcw9lqxs8trkpc',
        'DOT/axlUSDC' => 'kujira1337sclk2nc6srd77w4v8qule0nv9r70mrt56r2j8zak3rlg6xc0sl27tar',
        'DOT/USK' => 'kujira1uchf9h2suq6a9a0ksyp5rh9536uqxydswm37sswa888kxxx2kqgqsx3n6h',
        'FURY/USK' => 'kujira1hgq0fgqnv0dk2r474pfax3va86wfh9ffgdhx6q6jls00g7nv8vmsx2jnjt',
        'JUNO/USK' => 'kujira14sar6zdyljp7t9u5zwcwcjrw98kcmqq8685sz7ezfknvauqg23sqrmr6kg',
        'KUJI/ATOM' => 'kujira13y8hs83sk0la7na2w5g5nzrnjjpnkvmd7e87yd35g8dcph7dn0ksenay2a',
        'KUJI/axlUSDC' => 'kujira1sx99fxy4lqx0nv3ys86tkdrch82qygxyec5c8dxsk9raz4at5zpq72gypx',
        'KUJI/USK' => 'kujira1g9xcvvh48jlckgzw8ajl6dkvhsuqgsx2g8u3v0a6fx69h7f8hffqaqu36t',
        'LUNA/USK' => 'kujira1y0v5znl0ucc6nsdalr9xeg0r3zyw44yn0uyd8tsgc8gl4j8stjcs9vmmr7',
        'LUNA/axlUSDC' => 'kujira1hs0fmdp9m0udkm7f63z9l92c5z6qa44hg7gcn3kwwrcn8nkdq7vsx79u97',
        'local/USK' => 'kujira10wn7s0j66f33kp8rg7cluh9mghkahd5wezkx84wn3kf0cvh2nefsny50r4',
        'OSMO/USK' => 'kujira1hrvxn66u46r47zxsd45jecvuyr3munl2d5xle9gnltpge3dqh7sqd64znl',
        'SCRT/USK' => 'kujira10sx8wxzev270zrmpq6z3asgpurdjfh9f6rwtgt55mar9m6gtw40s9nfxcy',
        'SHD/USK' => 'kujira1r0sn3fcz2lda7hvs37rchnk4pq6jt5hjeqw7dcc765v39rhmv0tqj59760',
        'STARS/USK' => 'kujira1n648rfqqvjxm6c7zgfnfqay85rkapgg0z7da9pnmjazz5m5d7l0qxdtq90',
        'STRD/USK' => 'kujira1hmy36p0a87fsv36l8vdmy5uaka69j392s07qgnc5aum9cg9vj88qq8tfgh',
        'wBNB/USK' => 'kujira196yp2agkqa4fqh0asg4lhn53t7fuw5fd8p3avktvy9j0qxf5zlmsz25v0n',
        'wBNB/axlUSDC' => 'kujira1d4h7hnnn5na2zy9lh7k4atjscj9sxtpj7avnyelykgd22e5kyh2qpnsd5n',
        'wETH/axlUSDC' => 'kujira1ngqlypl5h0mkgxmk4why878eq4y5yh6yhdtrw8hdxfz202xluzrs097qn5',
        'wETH/USK' => 'kujira1xwvvjq5w0887v2vz4e83kcu38s0jq8q8lqa3z5hxm295q7y4uejqp24la7',
        'wMATIC/USK' => 'kujira10y2sxew858txsfufrv366hkdm5lgn8w6dkhtxv8mdsmh7z8yuzfq9tptmz',
        'KUJI/LUNA' => 'kujira1hfj06505jjk2ut5a0j6f5wx04pj2s05qk8nydng7kznkuzpe8w2se24jqx',
        'ampLUNA/LUNA' => 'kujira1uamjserhcm82ek775wtt2q9vfkc8k2de4zzxh25xqjzxah4naqjqdmtcs6'

    ];

    private ?array $orca_contracts = [
        'ATOM' => '/liquidations?&contracts[]=kujira1ecgazyd0waaj3g7l9cmy5gulhxkps2gmxu9ghducvuypjq68mq2smfdslf&contracts[]=kujira1m0z0kk0qqug74n9u9ul23e28x5fszr628h20xwt6jywjpp64xn4qkxmjq3&limit=80',
        'stATOM' => '/liquidations?&contracts[]=kujira19kl9ma0u7e9vdhw54mjahh052hcdwzpxmm840phffrff7v3perjsqxfajc&limit=80',
        'wETH' => '/liquidations?&contracts[]=kujira1fjews4jcm2yx7una77ds7jjjzlx5vgsessguve8jd8v5rc4cgw9s8rlff8&contracts[]=kujira1m4ves3ymz5hyrj3war3t7uxu9ewt8rwpunja87960n0gre3a5pzspgry4g&limit=80',


    ];

    public function get_api_urls(): array
    {
        return $this->api_urls;
    }

    public function get_tokens(): array
    {
        return $this->tokens;
    }

    public function get_fin_contracts(): array
    {
        return $this->fin_contracts;
    }

    public function get_bow_contracts(): array
    {
        return $this->bow_contracts;
    }

    public function get_uskminted_endpoints(): array
    {
        return $this->USKMintedEndpoints;
    }

    public function get_uskmargin_endpoints(): array
    {
        return $this->USKMarginEndpoints;
    }

    public function get_token_name($ibc_string, $tokens)
    {

        return array_keys($tokens, $ibc_string);
    }

}
