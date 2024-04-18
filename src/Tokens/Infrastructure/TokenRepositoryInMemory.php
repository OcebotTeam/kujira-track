<?php

namespace Ocebot\KujiraTrack\Tokens\Infrastructure;

use Ocebot\KujiraTrack\Tokens\Domain\Token;
use Ocebot\KujiraTrack\Tokens\Domain\TokenCollection;
use Ocebot\KujiraTrack\Tokens\Domain\TokenRepository;

final class TokenRepositoryInMemory implements TokenRepository
{
    private static $tokens = [
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
        'MNTA' => 'factory/kujira1643jxg8wasy5cfcn7xm8rd742yeazcksqlg4d7/umnta'
    ];

    public function findByTicker(string $ticker): ?Token
    {
        if (array_key_exists($ticker, self::$tokens)) {
            return new Token($ticker, self::$tokens[$ticker]);
        }

        return null;
    }

    public function findByIbc(string $ibc): ?Token
    {
        if (in_array($ibc, self::$tokens)) {
            return new Token(array_search($ibc, self::$tokens), $ibc);
        }

        return null;
    }

    public function findAll(): TokenCollection
    {
        $tokens = [];
        foreach (self::$tokens as $ticker => $ibc) {
            $tokens[] = new Token($ticker, $ibc);
        }

        return new TokenCollection($tokens);
    }
}
