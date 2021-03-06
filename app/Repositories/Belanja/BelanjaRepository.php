<?php namespace SimdesApp\Repositories\Belanja;

use SimdesApp\Models\Belanja;
use SimdesApp\Repositories\AbstractRepository;
use SimdesApp\Repositories\Contracts\BelanjaInterface;
use SimdesApp\Repositories\Contracts\JenisInterface;
use SimdesApp\Repositories\Contracts\KelompokInterface;
use SimdesApp\Repositories\Contracts\ObyekInterface;
use SimdesApp\Services\LaraCacheInterface;
class BelanjaRepository extends AbstractRepository implements BelanjaInterface
{
    /**
     * @var LaraCacheInterface
     */
    protected $cache;

    /**
     * @var ObyekInterface
     */
    protected $obyek;

    /**
     * @var KelompokInterface
     */
    protected $kelompok;

    /**
     * @var JenisInterface
     */
    protected $jenis;

    public function __construct(Belanja $belanja, LaraCacheInterface $cache, ObyekInterface $obyek, JenisInterface $jenis, KelompokInterface $kelompok)
    {
        $this->model = $belanja;
        $this->cache = $cache;
        $this->obyek = $obyek;
        $this->kelompok = $kelompok;
        $this->jenis = $jenis;
    }

    /**
     * Instant find or search with paging, limit, and query
     *
     * @param int  $page
     * @param int  $limit
     * @param null $term
     * @param null $organisasi_id
     *
     * @return mixed
     */
    public function find($page = 1, $limit = 10, $term = null, $organisasi_id)
    {
        // set key
        $key = 'belanja-find-' . $page . $limit . $term . $organisasi_id;
        // set section
        $section = 'belanja';
        // has section and key
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }
        // query to database
        $belanja = $this->model
            ->where('belanja', 'like', '%' . $term . '%')
            ->where('organisasi_id', '=', $organisasi_id)
            ->paginate($limit)
            ->toArray();
        // store to cache
        $this->cache->put($section, $key, $belanja, 10);

        return $belanja;
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            $belanja = $this->getNew();
            $kelompok_id = (empty($data['kelompok_id'])) ? '0' : $data['kelompok_id'];
            $jenis_id = (empty($data['jenis_id'])) ? '0' : $data['jenis_id'];
            $obyek_id = (empty($data['obyek_id'])) ? '0' : $data['obyek_id'];
            $satuan1 = (empty($data['satuan1'])) ? '' : $data['satuan1'];
            $satuan2 = (empty($data['satuan2'])) ? '' : $data['satuan2'];
            $satuan3 = (empty($data['satuan3'])) ? '' : $data['satuan3'];
            $volume1 = (empty($data['volume1'])) ? '1' : $data['volume1'];
            $volume2 = (empty($data['volume2'])) ? '1' : $data['volume2'];
            $volume3 = (empty($data['volume3'])) ? '1' : $data['volume3'];
            $satuan_harga = (empty($data['satuan_harga'])) ? '1' : $data['satuan_harga'];
            $jumlah = $volume1 * $volume2 * $volume3 * $satuan_harga;
            $belanja->belanja = $this->getNamaBelanja($kelompok_id, $jenis_id, $obyek_id);
            $belanja->kode_rekening = $this->getKodeRekening($kelompok_id, $jenis_id, $obyek_id);
            $belanja->tahun = e($data['tahun']);
            $belanja->kelompok_id = $kelompok_id;
            $belanja->jenis_id = $jenis_id;
            $belanja->obyek_id = $obyek_id;
            $belanja->satuan1 = $satuan1;
            $belanja->satuan2 = $satuan2;
            $belanja->satuan3 = $satuan3;
            $belanja->volume1 = (empty($data['volume1'])) ? '' : $data['volume1'];
            $belanja->volume2 = (empty($data['volume2'])) ? '' : $data['volume2'];
            $belanja->volume3 = (empty($data['volume3'])) ? '' : $data['volume3'];
            $belanja->satuan_harga = e($data['satuan_harga']);
            $belanja->jumlah = $jumlah;
            $belanja->rkpdes_id = e($data['rkpdes_id']);
            $belanja->kegiatan = e($data['kegiatan']);
            $belanja->save();

            /*Return result success*/

            return $this->successInsertResponse();
        } catch (\Exception $ex) {
            \Log::error('BelanjaRepository create action something wrong -' . $ex);

            return $this->errorInsertResponse();
        }
    }

    /**
     * Show the Record
     *
     * @param $id
     *
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update the record
     *
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data)
    {
        try {
            $belanja = $this->findById($id);
            if ($belanja) {
                $kelompok_id = (empty($data['kelompok_id'])) ? '0' : $data['kelompok_id'];
                $jenis_id = (empty($data['jenis_id'])) ? '0' : $data['jenis_id'];
                $obyek_id = (empty($data['obyek_id'])) ? '0' : $data['obyek_id'];
                $satuan1 = (empty($data['satuan1'])) ? '' : $data['satuan1'];
                $satuan2 = (empty($data['satuan2'])) ? '' : $data['satuan2'];
                $satuan3 = (empty($data['satuan3'])) ? '' : $data['satuan3'];
                $volume1 = (empty($data['volume1'])) ? '1' : $data['volume1'];
                $volume2 = (empty($data['volume2'])) ? '1' : $data['volume2'];
                $volume3 = (empty($data['volume3'])) ? '1' : $data['volume3'];
                $satuan_harga = (empty($data['satuan_harga'])) ? '1' : $data['satuan_harga'];
                $jumlah = $volume1 * $volume2 * $volume3 * $satuan_harga;
                $belanja->belanja = $this->getNamaBelanja($kelompok_id, $jenis_id, $obyek_id);
                $belanja->kode_rekening = $this->getKodeRekening($kelompok_id, $jenis_id, $obyek_id);
                $belanja->tahun = e($data['tahun']);
                $belanja->kelompok_id = $kelompok_id;
                $belanja->jenis_id = $jenis_id;
                $belanja->obyek_id = $obyek_id;
                $belanja->satuan1 = $satuan1;
                $belanja->satuan2 = $satuan2;
                $belanja->satuan3 = $satuan3;
                $belanja->volume1 = (empty($data['volume1'])) ? '' : $data['volume1'];
                $belanja->volume2 = (empty($data['volume2'])) ? '' : $data['volume2'];
                $belanja->volume3 = (empty($data['volume3'])) ? '' : $data['volume3'];
                $belanja->satuan_harga = e($data['satuan_harga']);
                $belanja->jumlah = $jumlah;
                $belanja->rkpdes_id = e($data['rkpdes_id']);
                $belanja->kegiatan = e($data['kegiatan']);
                $belanja->save();

                /*Return result success*/

                return $this->successUpdateResponse();
            }

            return $this->emptyDeleteResponse();
        } catch (\Exception $ex) {
            \Log::error('BelanjaRepository update action something wrong -' . $ex);

            return $this->errorUpdateResponse();
        }
    }

    /**
     * Destroy the record
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $belanja = $this->findById($id);
            if ($belanja) {
                $belanja->delete();

                // Return result success
                return $this->successDeleteResponse();
            }

            return $this->emptyDeleteResponse();
        } catch (\Exception $ex) {
            \Log::error('BelanjaRepository destroy action something wrong -' . $ex);

            return $this->errorDeleteResponse();
        }
    }

    /**
     * Get name pendapatan from kelompok, jenis, obyek
     *
     * @param $kelompok_id
     * @param $jenis_id
     * @param $obyek_id
     *
     * @return mixed
     */
    public function getNamaBelanja($kelompok_id, $jenis_id, $obyek_id)
    {
        if (!empty($obyek_id)) {
            return $this->obyek->getNamaObyek($obyek_id);
        } elseif (!empty($jenis_id)) {
            return $this->jenis->getNamaJenis($jenis_id);
        } elseif (!empty($kelompok_id)) {
            return $this->kelompok->getNamaKelompok($kelompok_id);
        }
    }

    /**
     * Get kode rekening from kelompok, jenis, obyek
     *
     * @param $kelompok_id
     * @param $jenis_id
     * @param $obyek_id
     *
     * @return mixed
     */
    public function getKodeRekening($kelompok_id, $jenis_id, $obyek_id)
    {
        if (!empty($obyek_id)) {
            return $this->obyek->getKodeRekening($obyek_id);
        } elseif (!empty($jenis_id)) {
            return $this->jenis->getKodeRekening($jenis_id);
        } elseif (!empty($kelompok_id)) {
            return $this->kelompok->getKodeRekening($kelompok_id);
        }
    }

    /**
     * get jumlah dpa
     *
     * @return mixed
     */
    public function getCountDpa()
    {
        // set key
        $key = 'belanja-count-dpa';
        // set section
        $section = 'belanja';
        // has section and key
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }
        // query to database
        $belanja = $this->model
            ->where('is_dpa', '=', 1)
            ->where('is_finish', '=', 0)
            ->count();
        // store to cache
        $this->cache->put($section, $key, $belanja, 10);

        return $belanja;
    }

    /**
     * get jumlah desa
     *
     * @param $organisasi_id
     *
     * @return mixed
     */
    public function getCountByDesa($organisasi_id)
    {
        // set key
        $key = 'belanja-get-count-by-desa' . $organisasi_id;
        // set section
        $section = 'belanja';
        // has section and key
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }
        // query to database
        $belanja = $this->model
            ->where('organisasi_id', '=', $organisasi_id)
            ->count();
        // store to cache
        $this->cache->put($section, $key, $belanja, 10);

        return $belanja;
    }

    /**
     * get jumlah rka by desa
     *
     * @param $organisasi_id
     *
     * @return mixed
     */
    public function getCountRkaByDesa($organisasi_id)
    {
        // set key
        $key = 'belanja-get-count-rka-by-desa' . $organisasi_id;
        // set section
        $section = 'belanja';
        // has section and key
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }
        // query to database
        $belanja = $this->model
            ->where('organisasi_id', '=', $organisasi_id)
            ->where('is_rka', '=', 1)
            ->count();
        // store to cache
        $this->cache->put($section, $key, $belanja, 10);

        return $belanja;
    }

    /**
     * get jumlah dpa by desa
     *
     * @param $organisasi_id
     *
     * @return mixed
     */
    public function getCountDpaByDesa($organisasi_id)
    {
        // set key
        $key = 'belanja-get-count-dpa-by-desa' . $organisasi_id;
        // set section
        $section = 'belanja';
        // has section and key
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }
        // query to database
        $belanja = $this->model
            ->where('organisasi_id', '=', $organisasi_id)
            ->where('is_dpa', '=', 1)
            ->count();
        // store to cache
        $this->cache->put($section, $key, $belanja, 10);

        return $belanja;
    }
}
