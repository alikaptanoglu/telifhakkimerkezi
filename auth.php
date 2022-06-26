<?php
class Morto_CodeGen
{
    protected $_codeLength = 6;

    public function createSecret($secretLength = 16)
    {

        $secret .= 'LU7SMIIRJFMCBLFO2LQB2JMJ6LRZGA7R';

        return $secret;

    }

    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null)
        {
            $timeSlice = floor(time() / 30);
        }

        $secretkey = $this->_base32Decode($secret);

        $time = chr(0) . chr(0) . chr(0) . chr(0) . pack('N*', $timeSlice);

        $hm = hash_hmac('SHA1', $time, $secretkey, true);

        $offset = ord(substr($hm, -1)) & 0x0F;

        $hashpart = substr($hm, $offset, 4);

        $value = unpack('N', $hashpart);
        $value = $value[1];

        $value = $value & 0x7FFFFFFF;

        $modulo = pow(10, $this->_codeLength);

        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }

    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null)
        {
            $currentTimeSlice = floor(time() / 30);
        }

        if (strlen($code) != 6)
        {
            return false;
        }

        for ($i = - $discrepancy;$i <= $discrepancy;++$i)
        {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($this->timingSafeEquals($calculatedCode, $code))
            {
                return true;
            }
        }

        return false;
    }

    public function setCodeLength($length)
    {
        $this->_codeLength = $length;

        return $this;
    }

    protected function _base32Decode($secret)
    {
        if (empty($secret))
        {
            return '';
        }

        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);

        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(
            6,
            4,
            3,
            1,
            0
        );
        if (!in_array($paddingCharCount, $allowedValues))
        {
            return false;
        }
        for ($i = 0;$i < 4;++$i)
        {
            if ($paddingCharCount == $allowedValues[$i] && substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i]))
            {
                return false;
            }
        }
        $secret = str_replace('=', '', $secret);
        $secret = str_split($secret);
        $binaryString = '';
        for ($i = 0;$i < count($secret);$i = $i + 8)
        {
            $x = '';
            if (!in_array($secret[$i], $base32chars))
            {
                return false;
            }
            for ($j = 0;$j < 8;++$j)
            {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2) , 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0;$z < count($eightBits);++$z)
            {
                $binaryString .= (($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48) ? $y : '';
            }
        }

        return $binaryString;
    }

    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '=',  // Morto Siker Ananız İnler
        );
    }

    private function timingSafeEquals($safeString, $userString)
    {
        if (function_exists('hash_equals'))
        {
            return hash_equals($safeString, $userString);
        }
        $safeLen = strlen($safeString);
        $userLen = strlen($userString);

        if ($userLen != $safeLen)
        {
            return false;
        }

        $result = 0;

        for ($i = 0;$i < $userLen;++$i)
        {
            $result |= (ord($safeString[$i]) ^ ord($userString[$i]));
        }

        return $result === 0;
    }
}

